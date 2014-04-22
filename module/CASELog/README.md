# CASE Log Module

## Dependencies
  -  https://github.com/enlitepro/enlite-monolog
  
```
{
    "require": {
        "enlitepro/enlite-monolog": "~1.1.0"
    }
}
```

## Usage

```php 
 //From Controller Action
 $this->getServiceLocator()->get('Logger')->addEmergency('blah');
```