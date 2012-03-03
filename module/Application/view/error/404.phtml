<h1>A 404 error occurred</h1>
<h2><?php echo $this->message ?></h2>

<?php if (isset($this->reason) && $this->reason): ?>

<?php
$reasonMessage= '';
switch ($this->reason) {
    case 'error-controller-cannot-dispatch':
        $reasonMessage = 'The requested controller was unable to dispatch the request.';
        break;
    case 'error-controller-not-found':
        $reasonMessage = 'The requested controller could not be mapped to an existing controller class.';
        break;
    case 'error-controller-invalid':
        $reasonMessage = 'The requested controller was not dispatchable.';
        break;
    case 'error-router-no-match':
        $reasonMessage = 'The requested URL could not be matched by routing.';
        break;
    default:
        $reasonMessage = 'We cannot determine at this time why a 404 was generated.';
        break;
}
?>

<p><?php echo $reasonMessage ?></p>

<?php endif ?>

<?php if (isset($this->controller) && $this->controller): ?>

<dl>
    <dt>Controller:</dt>
    <dd><?php $this->escape($this->controller) ?>
<?php
if (isset($this->controller_class) 
    && $this->controller_class
    && $this->controller_class != $this->controller
) {
    echo " (resolves to " . $this->escape($this->controller_class) . ")";
}
?>
</dd>

<?php endif ?>

<?php if (isset($this->exception) && $this->exception): ?>

<h2>Exception:</h2>

<p><b><?php echo $this->escape($this->exception->getMessage()) ?></b></p>

<h3>Stack trace</h3>

<pre>
<?php echo $this->exception->getTraceAsString() ?>
</pre>

<?php endif ?>
