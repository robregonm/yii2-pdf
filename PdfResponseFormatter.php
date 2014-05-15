<?php
/**
 *
 * @author Ricardo Obregón <ricardo@obregon.co>
 * @created 15/05/14 12:35 PM
 */

namespace app\components;

use Yii;
use yii\base\Component;
use yii\web\Response;
use yii\web\ResponseFormatterInterface;

/**
 * JsonResponseFormatter formats the given data into a JSON or JSONP response content.
 *
 * It is used by [[Response]] to format response data.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class PdfResponseFormatter extends Component implements ResponseFormatterInterface
{



	/**
	 * Formats the specified response.
	 *
	 * @param Response $response the response to be formatted.
	 */
	public function format($response)
	{
		$response->getHeaders()->set('Content-Type', 'application/pdf');
		$response->content = $this->formatPdf($response);
	}

	/**
	 * Formats response HTML in PDF
	 *
	 * @param Response $response
	 */
	protected function formatPdf($response)
	{
		$mpdf = new \mPDF();
		$mpdf->WriteHTML($response->data);
		return $mpdf->Output('', 'S');
	}
}
