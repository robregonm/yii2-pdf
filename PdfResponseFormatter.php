<?php
/**
 *
 * @author Ricardo Obregón <ricardo@obregon.co>
 * @created 15/05/14 12:35 PM
 */

namespace robregonm\pdf;

use Yii;
use yii\base\Component;
use yii\web\Response;
use yii\web\ResponseFormatterInterface;

/**
 * PdfResponseFormatter formats the given HTML data into a PDF response content.
 *
 * It is used by [[Response]] to format response data.
 *
 * @author Ricardo Obregón <robregonm@gmail.com>
 * @since 2.0
 */
class PdfResponseFormatter extends Component implements ResponseFormatterInterface
{
    /**
     * @var boolean whether to interpret Page as Landscape.
     * Default false that means as Portrait.
     */
    public $rotated = false;

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
        if ($this->rotated) {
            $mpdf->AddPage('L');
        }
        $mpdf->WriteHTML($response->data);
        return $mpdf->Output('', 'S');
    }
}
