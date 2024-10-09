<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeFilamentTeacher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:filament-teacher';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a Teacher user for filament';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // todo: complete the command below
//        $name = $this->ask('Name');
//        $email = $this->ask('Email');
//        $password = bcrypt($this->secret('Password'));
//
//        // Create a teacher user
//        $teacher = Teacher::create([
//            'name' => $name,
//            'email' => $email,
//            'password' => $password,
//        ]);
//
//        Filament::auth()->login($teacher);
//
//        $this->info('Teacher user created successfully!');
    }
}
