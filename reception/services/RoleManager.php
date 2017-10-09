<?php

namespace reception\services;

use yii\rbac\ManagerInterface;

class RoleManager
{
    private $manager;

    public function __construct(ManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function assign($userId, $name): void
    {
        $am = $this->manager;
        $am->revokeAll($userId);
        if (!$role = $am->getRole($name)) {
            throw new \DomainException('Role "' . $name . '" does not exist.');
        }
        $am->revokeAll($userId);
        $am->assign($role, $userId);
    }
    public function assignRoles($userId, $roles): void
    {
        $am = $this->manager;
        $am->revokeAll($userId);
        foreach ($roles as $name) {
            if (!$role = $am->getRole($name)) {
                throw new \DomainException('Role "' . $name . '" does not exist.');
            }
            $am->assign($role, $userId);
        }
    }
    public function getRoles($userId)
    {
        $am = $this->manager;
        return $am->getAssignments($userId);
    }
}