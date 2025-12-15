# DOCS

## Blocks içerisinde SpatieMediaLibraryFileUpload kullanımı
- Suffix, tek block içerisinde birden çok kullanım olursa ayırt etmek içindir
```php
Hidden::make('image_collection_id_{suffix}')
    ->default(str(Str::uuid()->toString())->replace('-', '')),

SpatieMediaLibraryFileUpload::make('image')
    ->customProperties(fn (Get $get): array => [
        'image_collection_id_{suffix}' => $get('image_collection_id_{suffix}'),
    ])
    ->filterMediaUsing(
        fn (Collection $media, Get $get): Collection => $media->where(
            'custom_properties.image_collection_id_{suffix}',
            $get('image_collection_id_{suffix}')
        )
    ),
```