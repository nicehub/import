# Import

## Usage

```
use Nicehub\Import\Readers\CsvReader;
use Nicehub\Import\Writers\WriterCallback;
use Nicehub\Import\Import;
use Nicehub\Import\FieldRename;

$filePath = __DIR__ . '/assets/basic.csv';

// Create reader
$file = new \SplFileObject($filePath);
$file->setCsvControl('~');
$reader = new CsvReader($file);

// Create writer
$writer = new WriterCallback(function($data) {
    return json_encode($data);
});

// Create fields rename
$renamer = new FieldRename([0 => 'name', 1 => 'price']);

// Create import object with reader and writer
$import = new Import($reader, $writer);

// Add fields rename and run import
$report = $import->setFieldRenamer($renamer)->execute();

print $report->count();
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
