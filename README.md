# Информация

Интеграция тега кода `SRC` в статью.

## Синтаксис

```
<src type="[TYPE]" lang="[LANGUAGE]">[CONTENT]</src>
```

Где `[TYPE]` это:
- `block` - блочное форматирование кода;
- `inline` - строчное форматирование кода.

## Установка

1. Загрузите папки и файлы в директорию `extensions/MW_EXT_Src`.
2. В самый низ файла `LocalSettings.php` добавьте строку:

```
wfLoadExtension( 'MW_EXT_Src' );
```

## Авторы

- [**Kitsune Solar**](https://kitsune.solar/) - разработчик.

## Ссылки

- [**METASTORE**](https://metastore.pro/) - хранилище открытых проектов [**METADATA**](https://metadata.foundation/).
- [**METADATA / Foundation**](https://metadata.foundation/) - поддержка и разработка открытых проектов.
