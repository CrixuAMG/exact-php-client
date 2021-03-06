<?php

namespace CrixuAMG\Financials\Exact;

/**
 * Class SalesOrderID.
 *
 * @see https://start.exactonline.nl/docs/HlpRestAPIResourcesDetails.aspx?name=SalesInvoiceSalesOrderID
 *
 * @property string $ID
 */
class SalesOrderID extends Model
{
    use Query\Findable;
    use Persistance\Storable;

    protected $fillable = [
        'ID',
    ];

    protected $url = 'salesinvoice/SalesOrderID';
}
