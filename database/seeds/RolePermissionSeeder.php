<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create Roles
        // $roleSuperAdmin=Role::create(['name' => 'admin']);
        // $roleAdmin=Role::create(['name' => 'admin']);

        // $roleEditor=Role::create(['name' => 'admin']);
        // $roleUser=Role::create(['name' => 'admin']);

        $roleSuperAdmin = Role::create(['guard_name' => 'web', 'name' => 'superadmin']);
        Role::create(['guard_name' => 'web', 'name' => 'chairman']);
        Role::create(['guard_name' => 'web', 'name' => 'teacher']);
        Role::create(['guard_name' => 'web', 'name' => 'student']);
        Role::create(['guard_name' => 'web', 'name' => 'block_user']);
          
        //Permission list as array
        $permissions=[
            //Dashboard
            [
                'group_name'=> 'Question',
                'permissions'=>[
                    'displayWelcome',
                    'addQuestion',
                    'editQuestion',
                    'deleteQuestion',
                    'saveQuestion',
                ]
                ],
                [
                    'group_name'=> 'Category',
                    'permissions'=>[
                        'addcategory',
                        'category.store',
                        'categoryList',
                        'category.edit',
                        'category.update',
                        'category.delete',
                        'displayParticularCategory',

                        
                    ]
                ],
                [
                    'group_name'=> 'User',
                    'permissions'=>[
                        'adduser',
                        'user.store',
                        'userlist',
                        'user.edit',
                        'user.update',
                        'user.delete',
                        
                    ]
                    ],
                    [
                        'group_name'=> 'Primary User',
                        'permissions'=>[
                            'addpuser',
                            'puser.store',
                            'puserlist',
                            'puser.edit',
                            'puser.update',
                            'puser.delete',
                            
                        ]
                        ],
                [
                    'group_name'=> 'Answer',
                    'permissions'=>[
                        'answers',
                        'addAnswer',
                        'editAnswer',
                        'deleteAnswer',
                        'saveAnswer',
                    ]
                    ],
                    [
                        'group_name'=> 'Reply',
                        'permissions'=>[
                            'addReply',
                            'saveReply',
                            'deleteReply',
                            'editReply',
                            
                        ]
                        ],
                    [
                        'group_name'=> 'Role',
                        'permissions'=>[
                            'roles.index',
                            'roles.create',
                            'roles.store',
                            'roles.update',
                            'roles.edit',
                            'roles.destroy',
                            'roles.show',
                            
                            
                        ]
                        ],
                        [
                            'group_name'=> 'Profile',
                            'permissions'=>[
                                'profileshow',
                                'displayParticularProfile',
                                'changepassword',
                                'update.password',
                            ]
                            ],
                            [
                                'group_name'=> 'Export Import',
                                'permissions'=>[
                                    'ex_import',
                                    'export',
                                    'import',
                                    
                                ]
                            ],
                            [
                                'group_name'=> 'Others',
                                'permissions'=>[
                                    'downLoadFile',
                                    'refresh_captcha',
                                    
                                ]
                            ],
                            [
                                'group_name'=> 'Ratings',
                                'permissions'=>[
                                    'ratings',
                                    
                                    
                                ]
                            ],
                            [
                                'group_name'=> 'Upvote_Downvote',
                                'permissions'=>[
                                    'upAnsSave',
                                    'upDownRepSave',
                                    
                                    
                                ]
                            ],
                            [
                                'group_name'=> 'Report',
                                'permissions'=>[
                                    'reportQuestion',
                                    'reportAnswer',
                                    'question_reportList',
                                    'answer_reportList',
                                    'delete_question_reportList',
                                    'delete_answer_reportList',
                                 
                                ]
                            ],
                            [
                                'group_name'=> 'Block_Unblock',
                                'permissions'=>[
                                    'blockUser',
                                    'unblockUser',
                       
                                 
                                ]
                            ],
                            [
                                'group_name'=> 'Message',
                                'permissions'=>[
                                    'messages',
                                    'mSave',
                                    'messSL',
                       
                                 
                                ]
                            ],
               
            
         ];
                //Create and Assign Permissions
               
        for($i=0; $i < count($permissions); $i++){
            $permissionGroup= $permissions[$i]['group_name'];
            for($j=0; $j < count($permissions[$i]['permissions']); $j++){
                
            //create Permission
            $permission = Permission::create(['name' =>$permissions[$i]['permissions'][$j],'group_name'=>$permissionGroup]);
            $roleSuperAdmin->givePermissionTo($permission);
            $permission->assignRole($roleSuperAdmin);

                
            }

        }
            

    }
}
