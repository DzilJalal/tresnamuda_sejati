<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use hscstudio\mimin\components\Mimin;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">HDS</span><span class="logo-lg">' . Yii::$app->name . '</span>', '#', ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
           <!--  <ul class="nav navbar-nav">
                <li class="active"><a href="#">Adminstrator <span class="sr-only">(current)</span></a></li>
                <li><a href="<?php echo \yii\helpers\Url::to(['hrd']) ?>">HRD</a></li>
                <li><a href="#">IT</a></li>
                <li><a href="#">General & HRD</a></li>
                <li><a href="#">Export</a></li>
            </ul>ul -->

            <?php //echo Nav::widget([
                // 'options' => ['class' => 'navbar-nav navbar-right'],
                // 'items' => [
                //     ['label' => 'Administrator', 'url' => ['/admin']],
                //     ['label' => 'IT', 'url' => ['/it']],
                //     ['label' => 'HRD & Umum', 'url' => ['/hrd']],
                //     // Yii::$app->user->isGuest ? (
                //     //         ['label' => 'Login', 'url' => ['/site/login']]
                //     //         ) : (
                //     //         '<li>'
                //     //         . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                //     //         . Html::submitButton(
                //     //                 'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link']
                //     //         )
                //     //         . Html::endForm()
                //     //         . '</li>'
                //     //         )
                // ],
            //]); ?>

            <?php
            $menuItems = [];

            if(Yii::$app->user->can('Administrator')){
                 $menuItems = [
                    ['label' => 'Administrator', 'url' => ['/admin']],
                    ['label' => 'Owner', 'url' => ['/owner']],
                    ['label' => 'Manager', 'url' => ['/manager']],
                    ['label' => 'Kasir', 'url' => ['/kasir']],
                 ];
            }else if(Yii::$app->user->can('Owner')){
                $menuItems = [
                    ['label' => 'Owner', 'url' => ['/it']],
                 ];
            }else if(Yii::$app->user->can('Manager')){
                $menuItems = [
                    ['label' => 'Manager', 'url' => ['/manager']],
                 ];
            }else if(Yii::$app->user->can('Kasir')){
                $menuItems = [
                    ['label' => 'Kasir', 'url' => ['/kasir']],
                 ];
            }

            $menuItems = Mimin::filterMenu($menuItems);

            echo Nav::widget([
                 'options' => ['class' => 'navbar-nav navbar-right'],
                'items' =>$menuItems
                ]);
            ?>
        </div>



        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $directoryAsset ?>/img/user7-128x128.jpg" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?php echo Yii::$app->user->identity->username; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $directoryAsset ?>/img/user7-128x128.jpg" class="img-circle"
                                 alt="User Image"/>

                            <p>
                                <?php echo Yii::$app->user->identity->username; ?> 
                                <small>Member since Nov. 2016</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </li> -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <?=
                                Html::a(
                                        'Sign out', ['/site/logout'], ['data-method' => 'post', 'class' => 'btn btn-primary btn-flat']
                                )
                                ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <!-- <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li> -->
            </ul>
        </div>
    </nav>
</header>
