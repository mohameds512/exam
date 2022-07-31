<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [

        'super-admin' => [
            'users' => 'c,r,u,d',
            'grades' => 'c,r,u,d',
            'classes' => 'c,r,u,d',
            'sections' => 'c,r,u,d',
            'subjects' => 'c,r,u,d',
            'unites' => 'c,r,u,d',
            'questions' => 'c,r,u,d',
            'exams' => 'c,r,u,d',
            'Permission' => 'c,r,u,d',
            'Role' => 'c,r,u,d',
            'stud' => 'p',
            'teacher' => 'p',
        ],
        'admin' => [
            'users' => 'c,r',
            'grades' => 'c,r,u,d',
            'classes' => 'c,r,u,d',
            'sections' => 'c,r,u,d',
            'subjects' => 'c,r,u,d',
            'unites' => 'c,r,u,d',
            'questions' => 'c,r,u,d',
            'exams' => 'c,r,u,d',
            'Permission' => 'r',
            'Role' => 'r',
            'stud' => 'p',
            'teacher' => 'p',
        ],

        'teacher' => [
            'grades' => 'c,r',
            'classes' => 'c,r',
            'sections' => 'c,r',
            'subjects' => 'c,r',
            'unites' => 'c,r',
            'questions' => 'c,r,u,d',
            'exams' => 'c,r,u,d',
            'teacher' => 'p',
        ],

        'student' => [
            'grades' => 'r',
            'classes' => 'r',
            'sections' => 'r',
            'subjects' => 'r',
            'unites' => 'r',
            'questions' => 'r',
            'exams' => 'r',
            'stud' => 'p',
        ],

    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        'p' => 'prof'
    ]
];
