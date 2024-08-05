<?php

namespace App\Console\Commands\CMS;

use App\Models\User;
use App\Models\Department;
use Illuminate\Console\Command;

class SetManagersEqualDepartmentHeads extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:heads';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Установить руководителей согласно подразделениям';

    /**
     * Execute the console command.
     */
    public function handle()
    {
//        foreach (Department::all() as $department) {
//            if (!$department->head) {
//                continue;
//            }
//
//            foreach ($department->users as $user) {
//                if ($user->id == $department->head->id) {
//                    continue;
//                }
//
//                $this->info("{$user->id} set manager {$department->head->id}");
//                $user->manager_id = $department->head->id;
//                $user->save();
//            }
//        }

        foreach (User::all() as $user) {
            $this->process($user);
        }
    }

    private function process(User $user)
    {
        $this->info("Hook to {$user->name} head.");

        $department = $user->department;
        $manager = $user->manager;

        if ($department == null || $manager == null || $manager->is_director) {
            $this->error("No manager or department.");
            return false;
        }

        $department->head_id = $manager->id;
        $department->save();

        $this->info("Department '{$department->title}' head is relinked to {$manager->name}.");
    }
}
