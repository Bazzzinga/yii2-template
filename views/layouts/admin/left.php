<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
            </div>
        </div>
        <?php
            $url = Yii::$app->controller->getRoute();

            $items = [];
            $items[] = ['label' => 'Меню', 'options' => ['class' => 'header']];
            $items[] = ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest];
            $items[] = [
                    'label' => 'Разделы',
                    'url' => ['/admin/category'],
                    'active' => in_array($url, [
                        'admin/category/view',
                        'admin/category/update',
                        'admin/category/create',
                        'admin/category/index'
                    ])
                ];

        ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],

                'items' => $items,
            ]
        ) ?>

    </section>

</aside>
<style>
    .skin-blue .sidebar-menu li li.header {
        color: #657e89;
        background: #283034;
        margin-left: -6px;
        padding: 5px 25px 5px 20px;
        font-size: 14px;
    }

    ul.treeview-menu a {
        white-space: normal;
    }

    ul.treeview-menu a i.fa {
        display: none;
    }
</style>