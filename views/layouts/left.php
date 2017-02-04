<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <!--<div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?php echo Yii::$app->user->identity->username; ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>-->

        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form> -->
        <!-- /.search form -->

        <?php
        $menuItems = [];
        if (Yii::$app->user->can('Administrator')) {
            $menuItems = [
                //['label' => 'Welcome', 'options' => ['class' => 'header']],
                //['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
                //['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],
                [
                    'label' => 'User Management',
                    'icon' => 'fa fa-share',
                    'url' => '#',
                    'items' => [
                        ['label' => 'Routes', 'icon' => 'fa fa-file-code-o', 'url' => ['/mimin/route'],],
                        ['label' => 'Roles', 'icon' => 'fa fa-dashboard', 'url' => ['/mimin/role'],],
                        ['label' => 'Users', 'icon' => 'fa fa-dashboard', 'url' => ['/mimin/user'],],
                    ],
                ],
                [
                    'label' => 'Master Data HRD',
                    'icon' => 'fa fa-share',
                    'url' => '#',
                    'items' => [
                        ['label' => 'Perusahaan', 'icon' => 'fa fa-file-code-o', 'url' => ['/hrd/perusahaan'],],
                        ['label' => 'Branch', 'icon' => 'fa fa-file-code-o', 'url' => ['/hrd/branch'],],
                        ['label' => 'Departement', 'icon' => 'fa fa-file-code-o', 'url' => ['/hrd/departement'],],
                        ['label' => 'Karyawan', 'icon' => 'fa fa-file-code-o', 'url' => ['/hrd/karyawan'],],
                    ],
                ],
                [
                    'label' => 'Master Data IT',
                    'icon' => 'fa fa-share',
                    'url' => '#',
                    'items' => [
                        ['label' => 'Request IT 06', 'icon' => 'fa fa-file-code-o', 'url' => ['/it/request'],],
                        [
                            'label' => 'Laporan Request',
                            'icon' => 'fa fa-circle-o',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Periodical', 'icon' => 'fa fa-circle-o', 'url' => ['/it/report-request'],],
                                ['label' => 'Email List', 'icon' => 'fa fa-circle-o', 'url' => ['/it/address-email'],],
                            ],
                        ],
                        [
                            'label' => 'Analisa Request',
                            'icon' => 'fa fa-circle-o',
                            'url' => '',
                            'items' => [
                                ['label' => 'Item Keluhan', 'icon' => 'fa fa-circle-o', 'url' => ['/it/item-request-detail'],],
                                ['label' => 'Analisa', 'icon' => 'fa fa-circle-o', 'url' => ['/it/analisa-request'],],
                            ],
                        ],

                    ],
                ],
            ];
        } else if (Yii::$app->user->can('IT')) {
            $menuItems = [
                [
                    'label' => 'Request IT - 06',
                    'icon' => 'fa fa-share',
                    'url' => '#',
                    'items' => [
                        ['label' => 'Buku Besar', 'icon' => 'fa fa-file-code-o', 'url' => ['/it/request'],],
                        ['label' => 'Analisa Request', 'icon' => 'fa fa-file-code-o', 'url' => ['/it/request'],],
                        [
                            'label' => 'Laporan Request',
                            'icon' => 'fa fa-circle-o',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Periodical', 'icon' => 'fa fa-circle-o', 'url' => '/it/report-request',],
                                ['label' => 'Analisa', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                            ],
                        ],
                    ],
                ],
            ];
        } else if (Yii::$app->user->can('HRD')) {
            $menuItems = [
                [
                    'label' => 'Master Data HRD',
                    'icon' => 'fa fa-share',
                    'url' => '#',
                    'items' => [
                        ['label' => 'Perusahaan', 'icon' => 'fa fa-file-code-o', 'url' => ['/hrd/perusahaan'],],
                        ['label' => 'Branch', 'icon' => 'fa fa-file-code-o', 'url' => ['/hrd/branch'],],
                        ['label' => 'Departement', 'icon' => 'fa fa-file-code-o', 'url' => ['/hrd/departement'],],
                        ['label' => 'Karyawan', 'icon' => 'fa fa-file-code-o', 'url' => ['/hrd/karyawan'],],
                    ],
                ],
            ];
        } else {
            $menuItems = [
                ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
            ];
        }

        echo dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => $menuItems
                // [
//                        [
//                            'label' => 'Same tools',
//                            'icon' => 'fa fa-share',
//                            'url' => '#',
//                            'items' => [
//                                ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
//                                ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
//                                [
//                                    'label' => 'Level One',
//                                    'icon' => 'fa fa-circle-o',
//                                    'url' => '#',
//                                    'items' => [
//                                        ['label' => 'Level Two', 'icon' => 'fa fa-circle-o', 'url' => '#',],
//                                        [
//                                            'label' => 'Level Two',
//                                            'icon' => 'fa fa-circle-o',
//                                            'url' => '#',
//                                            'items' => [
//                                                ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
//                                                ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
//                                            ],
//                                        ],
//                                    ],
//                                ],
//                            ],
//                        ],
                // ],
        ]);
        ?>

    </section>

</aside>
