<?php


namespace reception\useCases\manage\Feefo;

use reception\entities\MyRent\FeefoSchedule;
use reception\forms\MyRent\FeefoScheduleForm;
use reception\repositories\Feefo\FeefoScheduleRepository;

class  FeefoScheduleManageService
{
    private $feefoScheduleRepository;

    public function __construct(FeefoScheduleRepository $feefoScheduleRepository)
    {
        $this->feefoScheduleRepository = $feefoScheduleRepository;
    }

    public function create(FeefoScheduleForm $form, $keys): array
    {
        $array=[];
        foreach ($keys as $key) {
            $feefoSchedule= FeefoSchedule::create($key, $form->from, $form->to, time(), time());
            $this->feefoScheduleRepository->save($feefoSchedule);
        }
        return $array;
    }


    public function edit($id, FeefoScheduleForm $form): void
    {
        $feefoSchedule = $this->feefoScheduleRepository->get($id);

        $feefoSchedule->edit($form->id, $form->object_id, $form->from, $form->to, $form->created, time());

        $this->feefoScheduleRepository->save($feefoSchedule);
    }

    public function remove($id): void
    {
        $feefoSchedule = $this->feefoScheduleRepository->get($id);
        $this->feefoScheduleRepository->remove($feefoSchedule);
    }
}
