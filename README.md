# partTranslate

Фильтр для twig

* Подключается как расширение к шаблонизатору twig
* Применяется к строке как фильтр в шаблоне
* Переводит все маркеры в тексте, записанные в формате %\S+%
* Подготовлен к использованию через composer autoloader (согласно psr-4)

1) Установка
----------------------------------

    git clone git@github.com:bubnovKelnik/part-translate.git
    composer install --no-dev

2) Использование
-------------------------------------
```yml
#service.yml
twig.partTranslate:
    class: BubnovKelnik\Twig\Extension\PartTranslateExtension
    tags:
        - { name: twig.extension }
    calls:
        - [ setTranslator, [ @translator ] ]
```

```yml
#messages.yml
markers:
    tobe:
        translate: Маркер переведен
```

```twig
{# Ваш шаблон #}
Этот маркер требуется перевести: {{ 'markers.tobe.translate' | partTranslate }}
```
