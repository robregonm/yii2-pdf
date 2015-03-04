Yii2-PDF
========

PDF formatter for Yii2 using mPDF library.

This extension "format" HTML responses to PDF files (by default Yii2 includes HTML, JSON and XML formatters). Great for reports in PDF format using HTML views/layouts.

##Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require robregonm/yii2-pdf "*"
```

or add

```
"robregonm/yii2-pdf": "*"
```

to the require section of your `composer.json` file.

## Usage

Once the extension is installed, modify your application configuration to include:

```php
return [
	'components' => [
		...
		'response' => [
			'formatters' => [
				'pdf' => [
					'class' => 'robregonm\pdf\PdfResponseFormatter',
					'mode' => '', // Optional
					'format' => 'A4',  // Optional but recommended. http://mpdf1.com/manual/index.php?tid=184
					'defaultFontSize' => 0, // Optional
					'defaultFont' => '', // Optional
					'marginLeft' => 15, // Optional
					'marginRight' => 15, // Optional
					'marginTop' => 16, // Optional
					'marginBottom' => 16, // Optional
					'marginHeader' => 9, // Optional
					'marginFooter' => 9, // Optional
					'orientation' => 'Landscape', // optional. This value will be ignored if format is a string value.
					'options' => [
						// mPDF Variables
						// 'fontdata' => [
							// ... some fonts. http://mpdf1.com/manual/index.php?tid=454
						// ]
					]
				],
			]
		],
		...
	],
];
```

In the controller:

```php

class MyController extends Controller {
	public function actionPdf(){
		Yii::$app->response->format = 'pdf';
		
		// Rotate the page
		Yii::$container->set(Yii::$app->response->formatters['pdf']['class'], [
			'format' => [216, 356], // Legal page size in mm
			'orientation' => 'Landscape', // This value will be used when 'format' is an array only. Skipped when 'format' is empty or is a string
			'beforeRender' => function($mpdf, $data) {},
			]);
		
		$this->layout = '//print';
		return $this->render('myview', []);
	}
}

```

## License

Yii2-Pdf is released under the BSD-3 License. See the bundled `LICENSE.md` for details.


# Useful URLs

* [mPDF Manual](http://mpdf1.com/manual/index.php)

Enjoy!

[![Flattr this git repo](http://api.flattr.com/button/flattr-badge-large.png)](https://flattr.com/submit/auto?user_id=robregonm&url=https://github.com/robregonm/yii2-pdf&title=Yii2-PDF&language=&tags=github&category=software) 
