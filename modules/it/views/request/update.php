<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Request */
?>
<div class="request-update">

	<?=
	$this->render('_form', [
		'model' => $model,
		'modelLinkReqTipe' => $modelLinkReqTipe,
		'modelLinkReqItem' => $modelLinkReqItem,
		'selectedTipeRequest' => $selectedTipeRequest,
		])
	?>

	</div>
