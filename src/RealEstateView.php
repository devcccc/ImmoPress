<?php

/**
 *
 */
final class RealEstateView
{
    private $model;

    public function __construct(RealEstate $model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getValue($key)
    {
        return $this->model->getValue($key);
    }

    public function getLabel($key)
    {
        return $this->model->getLabel($key);
    }

    protected function isEnDateFormat($dateString)
    {
        $d = DateTime::createFromFormat('Y-m-d', $dateString);
        return $d && $d->format('Y-m-d') === $dateString;
    }

    public function getTableRow($key)
    {
        // -- hack (mermshaus)
        if ($key === 'hack-etage') {
            $dataFloor          = $this->model->getDataByKey('floor');
            $dataNumberOfFloors = $this->model->getDataByKey('numberOfFloors');

            $data['label'] = $dataFloor['label'];
            $data['value'] = $dataFloor['value'];

            if ($data['label']) {
                if (intval($dataNumberOfFloors['value']) >= intval($dataFloor['value'])) {
                    $data['value'] .= ' von ' . $dataNumberOfFloors['value'];
                }
            }
        // --
        } else {
            $data = $this->model->getDataByKey($key);

            if($data['value'] && $data['value'] != 'keine Angabe' ){

                // change point to comma
                if(is_numeric($data['value'])){
                    $data['value'] = str_replace('.', ',', $data['value']);
                }

                // add m2 suffix
                if(in_array($key,array('livingSpace', 'minDivisible', 'totalFloorSpace', 'netFloorSpace', 'additionalArea', 'plotArea', 'usableFloorSpace'))){
                    $data['value'] .= ' '.__('m<sup>2</sup>','immopress');
                }

                // add EUR suffix
                if(in_array($key,array('price', 'baseRent', 'totalRent', 'additionalCosts', 'serviceCharge', 'heatingCosts', 'parkingSpacePrice', 'rentSubsidy'))){
                    $data['value'] = $this->formatMoney($data['value']);
                }

                // add kWa suffix
                if(in_array($key,array('thermalCharacteristic'))){
                    $data['value'] .= ' '.__('kWh/(m² *a)','immopress');
                }

                // add Min. suffix
                if(in_array($key,array('distanceToPT', 'distanceToMRS', 'distanceToFM', 'distanceToAirport'))){
                    $data['value'] .= ' '.__('Min.','immopress');
                }

                // add meter suffix
                if(in_array($key,array('shopWindowLength'))){
                    $data['value'] .= ' '.__('m','immopress');
                }

                // format date
                if(in_array($key,array('freeFrom'))){
                    if($this->isEnDateFormat($data['value'])){
                        $dateObject = new DateTime($data['value']);
                        $data['value'] = $dateObject->format('d.m.Y');
                    }
                }

                //wrap to error message if no label defined
                if(!$data['label']){
                    $data['label'] = '<span style="color:red">'.$key.' ('.$this->model->getExposeType().')</span>';
                }
            }
        }

//            $out = "<tr class='immopress-field-".$data['key']."'>";
//            $out .= "<td class='immopress-key'>".$data['label']."</td>";
//            $out .= "<td class='immopress-value'>".$data['value']."</td>";
//            $out .= "</tr>";

        return $this->createRow($data['label'], $data['value'], $data['key']);
    }

    public function getTableRows($keyArray)
    {
        $out = '';

        foreach($keyArray as $key){
            $out .= $this->getTableRow($key);
        }

        if($out){
            return '<table class="immopress-fields">'.$out.'</table>';
        }
    }

    /**
     *
     * @param string $label
     * @param string $value
     * @param string $key
     * @return string
     */
    public function createRow($label, $value, $key = '')
    {
        if ('' === strval($label) || '' === strval($value) || 'keine Angabe' === strval($value)) {
            return '';
        }

        $keyClass = '';

        if ('' !== $key) {
            $keyClass = 'immopress-field-' . $key;
        }

        $keyClassHtml = '';

        if ('' !== $keyClass) {
            $keyClassHtml = ' class="' . $keyClass . '"';
        }

        // Hyphenation hard-coding

        $map = array(
            'Energieausweis'            => 'Energie&shy;ausweis',
            'Energieeffizienzklasse'    => 'Energie&shy;effizienz&shy;klasse',
            'Energieausweistyp'         => 'Energie&shy;ausweis&shy;typ',
            'Energieverbrauchskennwert' => 'Energie&shy;verbrauchs&shy;kennwert',
            'Verbrauchsausweis'         => 'Verbrauchs&shy;ausweis'
        );

        if (isset($map[$label])) {
            $label = $map[$label];
        }

        if (isset($map[$value])) {
            $value = $map[$value];
        }

        $out = '<tr' . $keyClassHtml . '>';
        $out .= '<td class="immopress-key">' . $label . '</td>';
        $out .= '<td class="immopress-value">' . $value . '</td>';
        $out .= "</tr>";

        return $out;
    }

    /**
     *
     * @param mixed $value
     */
    public function formatMoney($value)
    {
        $value = str_replace(',', '.', $value);

        if (is_numeric($value)) {
            $value = number_format((float)$value, 2, ',', '.');
        }

        $value .= ' ' . __('EUR', 'immopress');

        return $value;
    }

    /**
     *
     * @return int|float
     */
    public function calculateTotalRent()
    {
        return $this->model->calculateTotalRent();
    }
}
