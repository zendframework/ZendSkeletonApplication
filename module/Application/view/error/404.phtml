<h1><?php echo $this->translate('A 404 error occurred') ?></h1>
<h2><?php echo $this->message ?></h2>

<?php if (isset($this->reason) && $this->reason): ?>

<?php
$reasonMessage= '';
switch ($this->reason) {
    case 'error-controller-cannot-dispatch':
        $reasonMessage = $this->translate('The requested controller was unable to dispatch the request.');
        break;
    case 'error-controller-not-found':
        $reasonMessage = $this->translate('The requested controller could not be mapped to an existing controller class.');
        break;
    case 'error-controller-invalid':
        $reasonMessage = $this->translate('The requested controller was not dispatchable.');
        break;
    case 'error-router-no-match':
        $reasonMessage = $this->translate('The requested URL could not be matched by routing.');
        break;
    default:
        $reasonMessage = $this->translate('We cannot determine at this time why a 404 was generated.');
        break;
}
?>

<p><?php echo $reasonMessage ?></p>

<?php endif ?>

<?php if (isset($this->controller) && $this->controller): ?>

<dl>
    <dt><?php echo $this->translate('Controller') ?>:</dt>
    <dd><?php echo $this->escapeHtml($this->controller) ?>
<?php
if (isset($this->controller_class)
    && $this->controller_class
    && $this->controller_class != $this->controller
) {
    echo '(' . sprintf($this->translate('resolves to %s'), $this->escapeHtml($this->controller_class)) . ')';
}
?>
</dd>
</dl>

<?php endif ?>

<?php if (isset($this->exception) && $this->exception): ?>

<h2><?php echo $this->translate('Exception') ?>:</h2>

<p><b><?php echo $this->escapeHtml($this->exception->getMessage()) ?></b></p>

<h3><?php echo $this->translate('Stack trace') ?>:</h3>

<pre>
<?php echo $this->exception->getTraceAsString() ?>
</pre>

<?php endif ?>
