<?php
namespace FedEx\RateService\ComplexType;

use FedEx\AbstractComplexType;

/**
 * Documents the kind and quantity of an individual hazardous commodity in a package.
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Rate Service
 *
 * @property HazardousCommodityDescription $Description
 * @property HazardousCommodityQuantityDetail $Quantity
 * @property HazardousCommodityOptionDetail $Options

 */
class HazardousCommodityContent extends AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'HazardousCommodityContent';

    /**
     * Identifies and describes an individual hazardous commodity.
     *
     * @param HazardousCommodityDescription $description
     * @return $this
     */
    public function setDescription(HazardousCommodityDescription $description)
    {
        $this->values['Description'] = $description;
        return $this;
    }

    /**
     * Specifies the amount of the commodity in alternate units.
     *
     * @param HazardousCommodityQuantityDetail $quantity
     * @return $this
     */
    public function setQuantity(HazardousCommodityQuantityDetail $quantity)
    {
        $this->values['Quantity'] = $quantity;
        return $this;
    }

    /**
     * Customer-provided specifications for handling individual commodities.
     *
     * @param HazardousCommodityOptionDetail $options
     * @return $this
     */
    public function setOptions(HazardousCommodityOptionDetail $options)
    {
        $this->values['Options'] = $options;
        return $this;
    }
}
