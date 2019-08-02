<?php

/**
 *
 */
final class RealEstate
{
    private $data;

    private $exposeType;

    private $apiKeys;

    private $apiOptions;

    private $contactDetails;

    public function __construct($postId)
    {
        $apiData = unserialize(get_post_meta($postId)['immopress_fields'][0]);

        $this->data = $apiData['realEstate'];
        $this->exposeType = $this->data['exposeType'];
        $this->contactDetails = $apiData['contactDetails'];

        //set deeper level values on first level
        foreach($this->data as $v){
            if(is_array($v)){
                foreach($v as $ak => $av){
                    //if key on first level doesn't exist
                    if(!isset($this->data[$ak])){
                        $this->data[$ak] = $av;
                        if($ak == 'wgs84Coordinate' && is_array($av)){
                            foreach($av as $wgsKey => $wgs){
                                if(!isset($this->data[$wgsKey])) {
                                    $this->data[$wgsKey] = $wgs;
                                }
                            }
                        }
                    }
                }
            }
        }

        $this->data['courtage'] = $this->data['courtage']['courtage'];

        //calculate energy class
        /*$thermalCharacteristicValue = $this->data['thermalCharacteristic'];
        if($thermalCharacteristicValue){

            $energyClass = 'A+';
            if ($thermalCharacteristicValue >= 30) $energyClass = 'A';
            if ($thermalCharacteristicValue >= 50) $energyClass = 'B';
            if ($thermalCharacteristicValue >= 75) $energyClass = 'C';
            if ($thermalCharacteristicValue >= 100) $energyClass = 'D';
            if ($thermalCharacteristicValue >= 130) $energyClass = 'E';
            if ($thermalCharacteristicValue >= 160) $energyClass = 'F';
            if ($thermalCharacteristicValue >= 200) $energyClass = 'G';
            if ($thermalCharacteristicValue >= 250) $energyClass = 'H';

            $this->data['energyEfficiencyClass'] = $energyClass;
        }*/ //soll nicht mehr ausgegeben werden(ab 25.04.2016)

//        if(isset($_GET['vardump'])){
//            echo '<pre>';
//            ksort($this->data);
//            var_dump($this->data);
//            echo '</pre>';
//        }

        global $ImmoPress;

        //@todo übersetzungen auslagern
        $this->apiKeys = $ImmoPress->apiKeys;
        $this->apiOptions = $ImmoPress->apiOptions;
    }


    public function getValue($key)
    {
        $value = $this->data[$key];

        if(is_array($value)){
            $value = array_shift($value);
        }
        $optionValue = $this->apiOptions[$this->exposeType][$value];


        if($optionValue){
            return $optionValue;
        }

        return $value;
    }

    public function getLabel($key)
    {
        $label = $this->apiKeys[$this->exposeType][$key];

        return $label;
    }


    public function getDataByKey($key)
    {
        $label = $this->getLabel($key);
        $value = $this->getValue($key);

        return array('key' => $key, 'label' => $label, 'value' => $value);
    }

    public function getExposeType()
    {
        return $this->exposeType;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getContactDetails()
    {
        return $this->contactDetails;
    }

    /**
     *
     * @return float
     */
    public function calculateTotalRent()
    {
        if (isset($this->data['totalRent'])) {
            return (float) $this->data['totalRent'];
        }

        $res = (float) ($this->getValue('price') + $this->getValue('additionalCosts'));

        return $res;
    }
}
