<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::t('app', Yii::$app->name),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);

    // everyone can see Home page
    
    $menuItems[] = ['label' => Yii::t('app', 'UNIBL'), 'url' => 'http://unibl.org'];

    // display Users to admin+ roles
    if (Yii::$app->user->can('admin')) {
        $menuItems[] = ['label' => Yii::t('app', 'Users'), 'url' => ['/user/index']];
    }
    if (Yii::$app->user->can('employee')){
    	$menuItems[] = ['label' => Yii::t('app', 'Status'), 'url' => ['/status/index']];
	$menuItems[] = ['label' => Yii::t('app', 'Type'), 'url' => ['/type/index']];
	$menuItems[] = ['label' => Yii::t('app', 'Building'), 'url' => ['/building/index']];
	$menuItems[] = ['label' => Yii::t('app', 'Room'), 'url' => ['/room/index']];
	}

    // display Logout to logged in users
    if (Yii::$app->user->can('employee') || Yii::$app->user->can('member')) {
	$menuItems[] = ['label' => Yii::t('app', 'Item'), 'url' => ['/item/index']];
	$menuItems[] = ['label' => Yii::t('app', 'Person'), 'url' => ['/person/index']];	
	$menuItems[] = ['label' => Yii::t('app', 'Location'), 'url' => ['/location/index']];
	$menuItems[] = ['label' => Yii::t('app', 'Transition'), 'url' => ['/transition/index']];
	
        
$menuItems[] = [
            'label' => Yii::t('app', 'Logout'). ' (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }

    // display Signup and Login pages to guests of the site
    if (Yii::$app->user->isGuest) {
         $menuItems[] = ['label' => Yii::t('app', 'Signup'), 'url' => ['/site/signup']];
         $menuItems[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);

    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::t('app', Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
