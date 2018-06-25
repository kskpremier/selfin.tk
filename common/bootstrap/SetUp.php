<?php

namespace common\bootstrap;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use reception\dispatchers\AsyncEventDispatcher;
use reception\dispatchers\DeferredEventDispatcher;
use reception\dispatchers\EventDispatcher;
use reception\dispatchers\SimpleEventDispatcher;
use reception\entities\User\events\UserKeySend;
use reception\jobs\AsyncEventJobHandler;
use reception\listeners\User\UserKeySendListener;
use reception\listeners\User\UserSignupConfirmedListener;
use reception\listeners\User\UserSignupRequestedListener;
use reception\entities\User\events\UserSignUpConfirmed;
use reception\entities\User\events\UserSignUpRequested;
use reception\entities\Booking\events\DocumentAddRequested;
use reception\entities\User\events\UserMobileCreated;
use reception\entities\User\events\UserMobileTimeToUpdate;
use reception\listeners\Booking\DocumentAddListener;
use reception\listeners\User\UserMobileCreatedListener;
use reception\listeners\User\UserMobileTimeToUpdateListener;
use reception\useCases\ContactService;
use yii\base\BootstrapInterface;
use yii\base\ErrorHandler;
use yii\caching\Cache;
use yii\di\Container;
use yii\di\Instance;
use yii\mail\MailerInterface;
use yii\rbac\ManagerInterface;
use yii\queue\Queue;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = \Yii::$container;

//        $container->setSingleton(Logger::class, function () {
//            $logger = new Logger('Monolog');
//            $logger->pushHandler(new StreamHandler('/Users/superbrodyaga/Sites/reception/console/runtime/logs/monolog.log', Logger::debug));
//            return $logger;
//        });

        $container->setSingleton(Client::class, function ()  {
            $logger = new Logger('Monolog');
            $logger->pushHandler(new StreamHandler('/Users/superbrodyaga/Sites/reception/console/runtime/logs/monolog.log', Logger::DEBUG));
            return ClientBuilder::create()->setLogger($logger)->build();
        });

        $container->setSingleton(MailerInterface::class, function () use ($app) {
            return $app->mailer;
        });

        $container->setSingleton(ErrorHandler::class, function () use ($app) {
            return $app->errorHandler;
        });

        $container->setSingleton(Queue::class, function () use ($app) {
            return $app->get('queue');
        });

        $container->setSingleton(Cache::class, function () use ($app) {
            return $app->cache;
        });

        $container->setSingleton(ManagerInterface::class, function () use ($app) {
            return $app->authManager;
        });

        $container->setSingleton(ContactService::class, [], [
            $app->params['adminEmail']
        ]);

        //Диспетчер для всех событий - он их тупо помещает в очередь
        $container->setSingleton(EventDispatcher::class, DeferredEventDispatcher::class);

        //Декторатор для диспетчера - весь код по интерфейсу  EventDispatcheк будет использовать этот диспетчер
        $container->setSingleton(DeferredEventDispatcher::class, function (Container $container) {
            return new DeferredEventDispatcher(new AsyncEventDispatcher($container->get(Queue::class)));
        });

        //Самый простой диспетчер, который знает про все обработчики событий
        $container->setSingleton(SimpleEventDispatcher::class, function (Container $container) {
            return new SimpleEventDispatcher($container, [
                UserSignUpRequested::class => [UserSignupRequestedListener::class],
                UserSignUpConfirmed::class => [UserSignupConfirmedListener::class],
                UserMobileCreated::class=>[UserMobileCreatedListener::class],
                UserMobileTimeToUpdate::class=>[UserMobileTimeToUpdateListener::class],
                DocumentAddRequested::class => [DocumentAddListener::class],
                UserKeySend::class=>[UserKeySendListener::class]

            ]);
        });
        //Диспетчер для управления вызовом заданий из очереди событий в консоле
        $container->setSingleton(AsyncEventJobHandler::class, [], [
            Instance::of(SimpleEventDispatcher::class)
        ]);

    }
}