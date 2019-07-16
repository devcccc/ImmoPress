<?php

return call_user_func(function () {
    // IMMOSCOUT API OPTION VALUES FOR EXPOSE TYPES

    return array(
        // WOHNUNG

        'ApartmentRent' => array(

            // base information
            'YES'                              => __( 'ja', 'immopress' ),
            'NO'                              => __( 'nein', 'immopress' ),
            'NO_INFORMATION'                 => __( 'keine Angabe', 'immopress' ),
            'NOT_APPLICABLE'                 => __( 'keine Angabe', 'immopress' ),
            'NEGOTIABLE'                     => __( 'nach Vereinbarung', 'immopress' ),
            'true'                              => __( 'ja', 'immopress' ),
            'false'                              => __( 'nein', 'immopress' ),

            // apartmentType
            'ROOF_STOREY'                      => __( 'Dachgeschoss', 'immopress' ),
            'LOFT'                              => __( 'Loft', 'immopress' ),
            'MAISONETTE'                      => __( 'Maisonette', 'immopress' ),
            'PENTHOUSE'                          => __( 'Penthouse', 'immopress' ),
            'TERRACED_FLAT'                      => __( 'Terrassenwohnung', 'immopress' ),
            'GROUND_FLOOR'                      => __( 'Erdgeschosswohnung', 'immopress' ),
            'APARTMENT'                          => __( 'Etagenwohnung', 'immopress' ),
            'RAISED_GROUND_FLOOR'             => __( 'Hochparterre', 'immopress' ),
            'HALF_BASEMENT'                      => __( 'Souterrain', 'immopress' ),
            'OTHER'                              => __( 'Sonstige', 'immopress' ),

            // condition
            'FIRST_TIME_USE'                 => __( 'Erstbezug', 'immopress' ),
            'FIRST_TIME_USE_AFTER_REFURBISHMENT' => __( 'Erstbezug nach Sanierung', 'immopress' ),
            'MINT_CONDITION'                 => __( 'Neuwertig', 'immopress' ),
            'REFURBISHED'                     => __( 'Saniert', 'immopress' ),
            'MODERNIZED'                     => __( 'Modernisiert', 'immopress' ),
            'FULLY_RENOVATED'                 => __( 'Vollständig renoviert', 'immopress' ),
            'WELL_KEPT'                          => __( 'Gepflegt', 'immopress' ),
            'NEED_OF_RENOVATION'             => __( 'Renovierungsbedürftig', 'immopress' ),
            // 'NEGOTIABLE'                     => __( 'Nach Vereinbarung', 'immopress' ),
            'RIPE_FOR_DEMOLITION'             => __( 'Abbruchreif', 'immopress' ),

            // interiorQuality
            'LUXURY'                          => __( 'Luxuriös', 'immopress' ),
            'SOPHISTICATED'                      => __( 'Gehoben', 'immopress' ),
            'NORMAL'                          => __( 'Normal', 'immopress' ),
            'SIMPLE'                          => __( 'Einfach', 'immopress' ),

            // heatingType
            'SELF_CONTAINED_CENTRAL_HEATING' => __( 'Etagenheizung', 'immopress' ),
            'STOVE_HEATING'                      => __( 'Ofenheizung', 'immopress' ),
            'CENTRAL_HEATING'                 => __( 'Zentralheizung', 'immopress' ),
            // -- you'll need the query param "usenewenergysourceenev2014values=true"
            'COMBINED_HEAT_AND_POWER_PLANT'     => __( 'Blockheizkraftwerk', 'immopress' ),
            'ELECTRIC_HEATING'                 => __( 'Elektro-Heizung', 'immopress' ),
            'DISTRICT_HEATING'                 => __( 'Fernwärme', 'immopress' ),
            'FLOOR_HEATING'                      => __( 'Fußbodenheizung', 'immopress' ),
            'GAS_HEATING'                      => __( 'Gas-Heizung)', 'immopress' ),
            'WOOD_PELLET_HEATING'             => __( 'Holz-Pelletheizung', 'immopress' ),
            'NIGHT_STORAGE_HEATER'             => __( 'Nachtspeicherofen', 'immopress' ),
            'OIL_HEATING'                      => __( 'Öl-Heizung', 'immopress' ),
            'SOLAR_HEATING'                      => __( 'Solar-Heizung', 'immopress' ),
            'HEAT_PUMP'                      => __( 'Wärmepumpe', 'immopress' ),

            // firingType
            'GEOTHERMAL'                     => __( 'Erdwärme', 'immopress' ),
            'SOLAR_HEATING'                 => __( 'Solarheizung', 'immopress' ),
            'PELLET_HEATING'                 => __( 'Pelletheizung', 'immopress' ),
            'GAS'                              => __( 'Gas', 'immopress' ),
            'OIL'                              => __( 'Öl', 'immopress' ),
            // 'DISTRICT_HEATING'             => __( 'Fernwärme', 'immopress' ),
            'ELECTRICITY'                     => __( 'Strom', 'immopress' ),
            'COAL'                              => __( 'Kohle', 'immopress' ),

            // buildingEnergyRatingType
            'ENERGY_REQUIRED'                 => __( 'Bedarfsausweis', 'immopress' ),
            'ENERGY_CONSUMPTION'             => __( 'Verbrauchsausweis', 'immopress' ),

            // parkingSpaceType
            'GARAGE'                          => __( 'Garage', 'immopress' ),
            'OUTSIDE'                          => __( 'Außenstellplatz', 'immopress' ),
            'CARPORT'                          => __( 'Carport', 'immopress' ),
            'DUPLEX'                          => __( 'Duplex', 'immopress' ),
            'CAR_PARK'                          => __( 'Parkhaus', 'immopress' ),
            'UNDERGROUND_GARAGE'             => __( 'Tiefgarage', 'immopress' ),

            //energyCertificateAvailability
            'AVAILABLE'                         => __( 'liegt vor', 'immopress' )

        ),

        'ApartmentBuy' => array(

            // base information
            'YES'                              => __( 'ja', 'immopress' ),
            'NO'                              => __( 'nein', 'immopress' ),
            'NO_INFORMATION'                 => __( 'keine Angabe', 'immopress' ),
            'NOT_APPLICABLE'                 => __( 'keine Angabe', 'immopress' ),
            'NEGOTIABLE'                     => __( 'nach Vereinbarung', 'immopress' ),
            'true'                              => __( 'ja', 'immopress' ),
            'false'                              => __( 'nein', 'immopress' ),

            // apartmentType
            'ROOF_STOREY'                      => __( 'Dachgeschoss', 'immopress' ),
            'LOFT'                              => __( 'Loft', 'immopress' ),
            'MAISONETTE'                      => __( 'Maisonette', 'immopress' ),
            'PENTHOUSE'                          => __( 'Penthouse', 'immopress' ),
            'TERRACED_FLAT'                      => __( 'Terrassenwohnung', 'immopress' ),
            'GROUND_FLOOR'                      => __( 'Erdgeschosswohnung', 'immopress' ),
            'APARTMENT'                          => __( 'Etagenwohnung', 'immopress' ),
            'RAISED_GROUND_FLOOR'             => __( 'Hochparterre', 'immopress' ),
            'HALF_BASEMENT'                      => __( 'Souterrain', 'immopress' ),
            'OTHER'                              => __( 'Sonstige', 'immopress' ),

            // condition
            'FIRST_TIME_USE'                 => __( 'Erstbezug', 'immopress' ),
            'FIRST_TIME_USE_AFTER_REFURBISHMENT' => __( 'Erstbezug nach Sanierung', 'immopress' ),
            'MINT_CONDITION'                 => __( 'Neuwertig', 'immopress' ),
            'REFURBISHED'                     => __( 'Saniert', 'immopress' ),
            'MODERNIZED'                     => __( 'Modernisiert', 'immopress' ),
            'FULLY_RENOVATED'                 => __( 'Vollständig renoviert', 'immopress' ),
            'WELL_KEPT'                          => __( 'Gepflegt', 'immopress' ),
            'NEED_OF_RENOVATION'             => __( 'Renovierungsbedürftig', 'immopress' ),
            // 'NEGOTIABLE'                     => __( 'Nach Vereinbarung', 'immopress' ),
            'RIPE_FOR_DEMOLITION'             => __( 'Abbruchreif', 'immopress' ),

            // interiorQuality
            'LUXURY'                          => __( 'Luxuriös', 'immopress' ),
            'SOPHISTICATED'                      => __( 'Gehoben', 'immopress' ),
            'NORMAL'                          => __( 'Normal', 'immopress' ),
            'SIMPLE'                          => __( 'Einfach', 'immopress' ),

            // heatingType
            'SELF_CONTAINED_CENTRAL_HEATING' => __( 'Etagenheizung', 'immopress' ),
            'STOVE_HEATING'                      => __( 'Ofenheizung', 'immopress' ),
            'CENTRAL_HEATING'                 => __( 'Zentralheizung', 'immopress' ),
            // -- you'll need the query param "usenewenergysourceenev2014values=true"
            'COMBINED_HEAT_AND_POWER_PLANT'     => __( 'Blockheizkraftwerk', 'immopress' ),
            'ELECTRIC_HEATING'                 => __( 'Elektro-Heizung', 'immopress' ),
            'DISTRICT_HEATING'                 => __( 'Fernwärme', 'immopress' ),
            'FLOOR_HEATING'                      => __( 'Fußbodenheizung', 'immopress' ),
            'GAS_HEATING'                      => __( 'Gas-Heizung)', 'immopress' ),
            'WOOD_PELLET_HEATING'             => __( 'Holz-Pelletheizung', 'immopress' ),
            'NIGHT_STORAGE_HEATER'             => __( 'Nachtspeicherofen', 'immopress' ),
            'OIL_HEATING'                      => __( 'Öl-Heizung', 'immopress' ),
            'SOLAR_HEATING'                      => __( 'Solar', 'immopress' ),
            'HEAT_PUMP'                      => __( 'Wärmepumpe', 'immopress' ),

            // firingType
            'GEOTHERMAL'                     => __( 'Erdwärme', 'immopress' ),
            'SOLAR_HEATING'                 => __( 'Solarheizung', 'immopress' ),
            'PELLET_HEATING'                 => __( 'Pelletheizung', 'immopress' ),
            'GAS'                              => __( 'Gas', 'immopress' ),
            'OIL'                              => __( 'Öl', 'immopress' ),
            // 'DISTRICT_HEATING'             => __( 'Fernwärme', 'immopress' ),
            'ELECTRICITY'                     => __( 'Strom', 'immopress' ),
            'COAL'                              => __( 'Kohle', 'immopress' ),

            // buildingEnergyRatingType
            'ENERGY_REQUIRED'                 => __( 'Bedarfsausweis', 'immopress' ),
            'ENERGY_CONSUMPTION'             => __( 'Verbrauchsausweis', 'immopress' ),

            // parkingSpaceType
            'GARAGE'                          => __( 'Garage', 'immopress' ),
            'OUTSIDE'                          => __( 'Außenstellplatz', 'immopress' ),
            'CARPORT'                          => __( 'Carport', 'immopress' ),
            'DUPLEX'                          => __( 'Duplex', 'immopress' ),
            'CAR_PARK'                          => __( 'Parkhaus', 'immopress' ),
            'UNDERGROUND_GARAGE'             => __( 'Tiefgarage', 'immopress' ),

            // merketingType
            'PURCHASE'                          => __( 'Kauf', 'immopress' ),
            'Zahlungsintervall'                 => __( 'Einmalzahlung', 'immopress' )

        ),


        // HAUS

        'HouseRent' => array(

            // base information
            'YES'                              => __( 'ja', 'immopress' ),
            'NO'                              => __( 'nein', 'immopress' ),
            'NO_INFORMATION'                 => __( 'keine Angabe', 'immopress' ),
            'NOT_APPLICABLE'                 => __( 'keine Angabe', 'immopress' ),
            'NEGOTIABLE'                     => __( 'nach Vereinbarung', 'immopress' ),
            'true'                              => __( 'ja', 'immopress' ),
            'false'                              => __( 'nein', 'immopress' ),

            // buildingType
            'SINGLE_FAMILY_HOUSE'             => __( 'Einfamilienhaus', 'immopress' ),
            'MID_TERRACE_HOUSE'                 => __( 'Reihenmittelhaus', 'immopress' ),
            'END_TERRACE_HOUSE'                 => __( 'Reiheneckhaus', 'immopress' ),
            'MULTI_FAMILY_HOUSE'             => __( 'Mehrfamilienhaus', 'immopress' ),
            'BUNGALOW'                          => __( 'Bungalow', 'immopress' ),
            'FARMHOUSE'                          => __( 'Bauernhaus', 'immopress' ),
            'SEMIDETACHED_HOUSE'             => __( 'Doppelhaushälfte', 'immopress' ),
            'VILLA'                             => __( 'Villa', 'immopress' ),
            'CASTLE_MANOR_HOUSE'             => __( 'Burg/Schloss', 'immopress' ),
            'SPECIAL_REAL_ESTATE'             => __( 'Besondere Immobilie', 'immopress' ),
            'OTHER'                          => __( 'Sonstiges', 'immopress' ),

            // condition
            'FIRST_TIME_USE'                 => __( 'Erstbezug', 'immopress' ),
            'FIRST_TIME_USE_AFTER_REFURBISHMENT' => __( 'Erstbezug nach Sanierung', 'immopress' ),
            'MINT_CONDITION'                 => __( 'Neuwertig', 'immopress' ),
            'REFURBISHED'                     => __( 'Saniert', 'immopress' ),
            'MODERNIZED'                     => __( 'Modernisiert', 'immopress' ),
            'FULLY_RENOVATED'                 => __( 'Vollständig renoviert', 'immopress' ),
            'WELL_KEPT'                          => __( 'Gepflegt', 'immopress' ),
            'NEED_OF_RENOVATION'             => __( 'Renovierungsbedürftig', 'immopress' ),
            // 'NEGOTIABLE'                     => __( 'Nach Vereinbarung', 'immopress' ),
            'RIPE_FOR_DEMOLITION'             => __( 'Abbruchreif', 'immopress' ),

            // interiorQuality
            'LUXURY'                          => __( 'Luxuriös', 'immopress' ),
            'SOPHISTICATED'                      => __( 'Gehoben', 'immopress' ),
            'NORMAL'                          => __( 'Normal', 'immopress' ),
            'SIMPLE'                          => __( 'Einfach', 'immopress' ),

            // heatingType
            'SELF_CONTAINED_CENTRAL_HEATING' => __( 'Etagenheizung', 'immopress' ),
            'STOVE_HEATING'                      => __( 'Ofenheizung', 'immopress' ),
            'CENTRAL_HEATING'                 => __( 'Zentralheizung', 'immopress' ),
            // -- you'll need the query param "usenewenergysourceenev2014values=true"
            'COMBINED_HEAT_AND_POWER_PLANT'     => __( 'Blockheizkraftwerk', 'immopress' ),
            'ELECTRIC_HEATING'                 => __( 'Elektro-Heizung', 'immopress' ),
            'DISTRICT_HEATING'                 => __( 'Fernwärme', 'immopress' ),
            'FLOOR_HEATING'                      => __( 'Fußbodenheizung', 'immopress' ),
            'GAS_HEATING'                      => __( 'Gas-Heizung)', 'immopress' ),
            'WOOD_PELLET_HEATING'             => __( 'Holz-Pelletheizung', 'immopress' ),
            'NIGHT_STORAGE_HEATER'             => __( 'Nachtspeicherofen', 'immopress' ),
            'OIL_HEATING'                      => __( 'Öl-Heizung', 'immopress' ),
            'SOLAR_HEATING'                      => __( 'Solar-Heizung', 'immopress' ),
            'HEAT_PUMP'                      => __( 'Wärmepumpe', 'immopress' ),

            // firingTypes
            'GEOTHERMAL'                     => __( 'Erdwärme', 'immopress' ),
            'SOLAR_HEATING'                 => __( 'Solarheizung', 'immopress' ),
            'PELLET_HEATING'                 => __( 'Pelletheizung', 'immopress' ),
            'GAS'                              => __( 'Gas', 'immopress' ),
            'OIL'                              => __( 'Öl', 'immopress' ),
            // 'DISTRICT_HEATING'             => __( 'Fernwärme', 'immopress' ),
            'ELECTRICITY'                     => __( 'Strom', 'immopress' ),
            'COAL'                              => __( 'Kohle', 'immopress' ),

            // buildingEnergyRatingType
            'ENERGY_REQUIRED'                 => __( 'Bedarfsausweis', 'immopress' ),
            'ENERGY_CONSUMPTION'             => __( 'Verbrauchsausweis', 'immopress' ),

            // parkingSpaceType
            'GARAGE'                          => __( 'Garage', 'immopress' ),
            'OUTSIDE'                          => __( 'Außenstellplatz', 'immopress' ),
            'CARPORT'                          => __( 'Carport', 'immopress' ),
            'DUPLEX'                          => __( 'Duplex', 'immopress' ),
            'CAR_PARK'                          => __( 'Parkhaus', 'immopress' ),
            'UNDERGROUND_GARAGE'             => __( 'Tiefgarage', 'immopress' ),

        ),

        'HouseBuy' => array(

            // base information
            'YES'                              => __( 'ja', 'immopress' ),
            'NO'                              => __( 'nein', 'immopress' ),
            'NO_INFORMATION'                 => __( 'keine Angabe', 'immopress' ),
            'NOT_APPLICABLE'                 => __( 'keine Angabe', 'immopress' ),
            'NEGOTIABLE'                     => __( 'nach Vereinbarung', 'immopress' ),
            'true'                              => __( 'ja', 'immopress' ),
            'false'                              => __( 'nein', 'immopress' ),

            // buildingType
            'SINGLE_FAMILY_HOUSE'             => __( 'Einfamilienhaus', 'immopress' ),
            'MID_TERRACE_HOUSE'                 => __( 'Reihenmittelhaus', 'immopress' ),
            'END_TERRACE_HOUSE'                 => __( 'Reiheneckhaus', 'immopress' ),
            'MULTI_FAMILY_HOUSE'             => __( 'Mehrfamilienhaus', 'immopress' ),
            'BUNGALOW'                          => __( 'Bungalow', 'immopress' ),
            'FARMHOUSE'                          => __( 'Bauernhaus', 'immopress' ),
            'SEMIDETACHED_HOUSE'             => __( 'Doppelhaushälfte', 'immopress' ),
            'VILLA'                             => __( 'Villa', 'immopress' ),
            'CASTLE_MANOR_HOUSE'             => __( 'Burg/Schloss', 'immopress' ),
            'SPECIAL_REAL_ESTATE'             => __( 'Besondere Immobilie', 'immopress' ),
            'OTHER'                          => __( 'Sonstiges', 'immopress' ),

            // condition
            'FIRST_TIME_USE'                 => __( 'Erstbezug', 'immopress' ),
            'FIRST_TIME_USE_AFTER_REFURBISHMENT' => __( 'Erstbezug nach Sanierung', 'immopress' ),
            'MINT_CONDITION'                 => __( 'Neuwertig', 'immopress' ),
            'REFURBISHED'                     => __( 'Saniert', 'immopress' ),
            'MODERNIZED'                     => __( 'Modernisiert', 'immopress' ),
            'FULLY_RENOVATED'                 => __( 'Vollständig renoviert', 'immopress' ),
            'WELL_KEPT'                          => __( 'Gepflegt', 'immopress' ),
            'NEED_OF_RENOVATION'             => __( 'Renovierungsbedürftig', 'immopress' ),
            // 'NEGOTIABLE'                     => __( 'Nach Vereinbarung', 'immopress' ),
            'RIPE_FOR_DEMOLITION'             => __( 'Abbruchreif', 'immopress' ),

            // interiorQuality
            'LUXURY'                          => __( 'Luxuriös', 'immopress' ),
            'SOPHISTICATED'                      => __( 'Gehoben', 'immopress' ),
            'NORMAL'                          => __( 'Normal', 'immopress' ),
            'SIMPLE'                          => __( 'Einfach', 'immopress' ),

            // heatingType
            'SELF_CONTAINED_CENTRAL_HEATING' => __( 'Etagenheizung', 'immopress' ),
            'STOVE_HEATING'                      => __( 'Ofenheizung', 'immopress' ),
            'CENTRAL_HEATING'                 => __( 'Zentralheizung', 'immopress' ),
            // -- you'll need the query param "usenewenergysourceenev2014values=true"
            'COMBINED_HEAT_AND_POWER_PLANT'     => __( 'Blockheizkraftwerk', 'immopress' ),
            'ELECTRIC_HEATING'                 => __( 'Elektro-Heizung', 'immopress' ),
            'DISTRICT_HEATING'                 => __( 'Fernwärme', 'immopress' ),
            'FLOOR_HEATING'                      => __( 'Fußbodenheizung', 'immopress' ),
            'GAS_HEATING'                      => __( 'Gas-Heizung)', 'immopress' ),
            'WOOD_PELLET_HEATING'             => __( 'Holz-Pelletheizung', 'immopress' ),
            'NIGHT_STORAGE_HEATER'             => __( 'Nachtspeicherofen', 'immopress' ),
            'OIL_HEATING'                      => __( 'Öl-Heizung', 'immopress' ),
            'SOLAR_HEATING'                      => __( 'Solar-Heizung', 'immopress' ),
            'HEAT_PUMP'                      => __( 'Wärmepumpe', 'immopress' ),

            // firingTypes
            'GEOTHERMAL'                     => __( 'Erdwärme', 'immopress' ),
            'SOLAR_HEATING'                 => __( 'Solarheizung', 'immopress' ),
            'PELLET_HEATING'                 => __( 'Pelletheizung', 'immopress' ),
            'GAS'                              => __( 'Gas', 'immopress' ),
            'OIL'                              => __( 'Öl', 'immopress' ),
            // 'DISTRICT_HEATING'             => __( 'Fernwärme', 'immopress' ),
            'ELECTRICITY'                     => __( 'Strom', 'immopress' ),
            'COAL'                              => __( 'Kohle', 'immopress' ),

            // buildingEnergyRatingType
            'ENERGY_REQUIRED'                 => __( 'Bedarfsausweis', 'immopress' ),
            'ENERGY_CONSUMPTION'             => __( 'Verbrauchsausweis', 'immopress' ),

            // parkingSpaceType
            'GARAGE'                          => __( 'Garage', 'immopress' ),
            'OUTSIDE'                          => __( 'Außenstellplatz', 'immopress' ),
            'CARPORT'                          => __( 'Carport', 'immopress' ),
            'DUPLEX'                          => __( 'Duplex', 'immopress' ),
            'CAR_PARK'                          => __( 'Parkhaus', 'immopress' ),
            'UNDERGROUND_GARAGE'             => __( 'Tiefgarage', 'immopress' ),

            // merketingType
            'PURCHASE'                          => __( 'Kauf', 'immopress' ),
            'Zahlungsintervall'                 => __( 'Einmalzahlung', 'immopress' )

        ),


        // GRUNDSTÜCK

        'LivingRentSite' => array(
        ),

        'LivingBuySite' => array(
        ),


        // GARAGE/STELLPLATZ

        'GarageRent' => array(

            // base information
            'YES'                              => __( 'ja', 'immopress' ),
            'NO'                              => __( 'nein', 'immopress' ),
            'NO_INFORMATION'                 => __( 'keine Angabe', 'immopress' ),
            'NOT_APPLICABLE'                 => __( 'keine Angabe', 'immopress' ),
            'NEGOTIABLE'                     => __( 'nach Vereinbarung', 'immopress' ),
            'true'                              => __( 'ja', 'immopress' ),
            'false'                              => __( 'nein', 'immopress' ),

            // garageType
            'GARAGE'                         => __( 'Garage', 'immopress' ),
            'STREET_PARKING'                 => __( 'Aussenstellplatz', 'immopress' ),
            'CARPORT'                         => __( 'Carport', 'immopress' ),
            'DUPLEX'                         => __( 'Duplex', 'immopress' ),
            'CAR_PARK'                          => __( 'Parkhaus', 'immopress' ),
            'UNDERGROUND_GARAGE'             => __( 'Tiefgarage', 'immopress' ),

            // condition
            'FIRST_TIME_USE'                 => __( 'Erstbezug', 'immopress' ),
            'FIRST_TIME_USE_AFTER_REFURBISHMENT' => __( 'Erstbezug nach Sanierung', 'immopress' ),
            'MINT_CONDITION'                 => __( 'Neuwertig', 'immopress' ),
            'REFURBISHED'                     => __( 'Saniert', 'immopress' ),
            'MODERNIZED'                     => __( 'Modernisiert', 'immopress' ),
            'FULLY_RENOVATED'                 => __( 'Vollständig renoviert', 'immopress' ),
            'WELL_KEPT'                          => __( 'Gepflegt', 'immopress' ),
            'NEED_OF_RENOVATION'             => __( 'Renovierungsbedürftig', 'immopress' ),
            // 'NEGOTIABLE'                     => __( 'Nach Vereinbarung', 'immopress' ),
            'RIPE_FOR_DEMOLITION'             => __( 'Abbruchreif', 'immopress' ),

        ),

        'GarageBuy' => array(

            // base information
            'YES'                              => __( 'ja', 'immopress' ),
            'NO'                              => __( 'nein', 'immopress' ),
            'NO_INFORMATION'                 => __( 'keine Angabe', 'immopress' ),
            'NOT_APPLICABLE'                 => __( 'keine Angabe', 'immopress' ),
            'NEGOTIABLE'                     => __( 'nach Vereinbarung', 'immopress' ),
            'true'                              => __( 'ja', 'immopress' ),
            'false'                              => __( 'nein', 'immopress' ),

            // garageType
            'GARAGE'                         => __( 'Garage', 'immopress' ),
            'STREET_PARKING'                 => __( 'Aussenstellplatz', 'immopress' ),
            'CARPORT'                         => __( 'Carport', 'immopress' ),
            'DUPLEX'                         => __( 'Duplex', 'immopress' ),
            'CAR_PARK'                          => __( 'Parkhaus', 'immopress' ),
            'UNDERGROUND_GARAGE'             => __( 'Tiefgarage', 'immopress' ),

            // condition
            'FIRST_TIME_USE'                 => __( 'Erstbezug', 'immopress' ),
            'FIRST_TIME_USE_AFTER_REFURBISHMENT' => __( 'Erstbezug nach Sanierung', 'immopress' ),
            'MINT_CONDITION'                 => __( 'Neuwertig', 'immopress' ),
            'REFURBISHED'                     => __( 'Saniert', 'immopress' ),
            'MODERNIZED'                     => __( 'Modernisiert', 'immopress' ),
            'FULLY_RENOVATED'                 => __( 'Vollständig renoviert', 'immopress' ),
            'WELL_KEPT'                          => __( 'Gepflegt', 'immopress' ),
            'NEED_OF_RENOVATION'             => __( 'Renovierungsbedürftig', 'immopress' ),
            // 'NEGOTIABLE'                     => __( 'Nach Vereinbarung', 'immopress' ),
            'RIPE_FOR_DEMOLITION'             => __( 'Abbruchreif', 'immopress' ),

        ),


        // GEWERBEOBJEKT

        'Office' => array(

            // base information
            'YES'                              => __( 'ja', 'immopress' ),
            'NO'                              => __( 'nein', 'immopress' ),
            'NO_INFORMATION'                 => __( 'keine Angabe', 'immopress' ),
            'NOT_APPLICABLE'                 => __( 'keine Angabe', 'immopress' ),
            'NEGOTIABLE'                     => __( 'nach Vereinbarung', 'immopress' ),
            'BY_APPOINTMENT'                 => __( 'nach Absprache', 'immopress' ),
            'true'                              => __( 'ja', 'immopress' ),
            'false'                              => __( 'nein', 'immopress' ),

            // officeType
            'LOFT'                              => __( 'Loft', 'immopress' ),
            'STUDIO'                         => __( 'Atelier', 'immopress' ),
            'OFFICE'                         => __( 'Büro', 'immopress' ),
            'OFFICE_FLOOR'                     => __( 'Büroetage', 'immopress' ),
            'OFFICE_BUILDING'                 => __( 'Bürohaus', 'immopress' ),                   // *
            'OFFICE_CENTRE'                     => __( 'Bürozentrum', 'immopress' ),
            'OFFICE_STORAGE_BUILDING'         => __( 'Büro- und Lagergebäude', 'immopress' ),
            'SURGERY'                         => __( 'Praxis', 'immopress' ),
            'SURGERY_FLOOR'                     => __( 'Praxisetage', 'immopress' ),
            'SURGERY_BUILDING'                 => __( 'Praxisgebäude', 'immopress' ),
            'COMMERCIAL_CENTRE'                 => __( 'Gewerbezentrum', 'immopress' ),
            'LIVING_AND_COMMERCIAL_BUILDING' => __( 'Wohn- und Geschäftsgebäude', 'immopress' ),
            'OFFICE_AND_COMMERCIAL_BUILDING' => __( 'Büro- und Geschäftsgebäude', 'immopress' ),

            // flooringType
            'CONCRETE'                          => __( 'Beton', 'immopress' ),
            'EPOXY_RESIN'                      => __( 'Epoxidharz', 'immopress' ),
            'TILES'                              => __( 'Fliesen', 'immopress' ),
            'PLANKS'                          => __( 'Dielen', 'immopress' ),
            'LAMINATE'                          => __( 'Laminat', 'immopress' ),
            'PARQUET'                          => __( 'Parkett', 'immopress' ),
            'PVC'                              => __( 'PVC', 'immopress' ),
            'CARPET'                          => __( 'Teppichboden', 'immopress' ),
            'ANTISTATIC_FLOOR'                  => __( 'Teppichboden (Antistatisch)', 'immopress' ),
            'OFFICE_CARPET'                      => __( 'Teppichfliesen (Stuhlrollenfest)', 'immopress' ),
            'STONE'                              => __( 'Stein', 'immopress' ),
            'CUSTOMIZABLE'                      => __( 'nach Wunsch', 'immopress' ),
            'WITHOUT'                          => __( 'ohne Bodenbelag', 'immopress' ),

            // condition
            'FIRST_TIME_USE'                 => __( 'Erstbezug', 'immopress' ),
            'FIRST_TIME_USE_AFTER_REFURBISHMENT' => __( 'Erstbezug nach Sanierung', 'immopress' ),
            'MINT_CONDITION'                 => __( 'Neuwertig', 'immopress' ),
            'REFURBISHED'                     => __( 'Saniert', 'immopress' ),
            'MODERNIZED'                     => __( 'Modernisiert', 'immopress' ),
            'FULLY_RENOVATED'                 => __( 'Vollständig renoviert', 'immopress' ),
            'WELL_KEPT'                          => __( 'Gepflegt', 'immopress' ),
            'NEED_OF_RENOVATION'             => __( 'Renovierungsbedürftig', 'immopress' ),
            // 'NEGOTIABLE'                     => __( 'Nach Vereinbarung', 'immopress' ),
            'RIPE_FOR_DEMOLITION'             => __( 'Abbruchreif', 'immopress' ),

            // interiorQuality
            'LUXURY'                          => __( 'Luxuriös', 'immopress' ),
            'SOPHISTICATED'                      => __( 'Gehoben', 'immopress' ),
            'NORMAL'                          => __( 'Normal', 'immopress' ),
            'SIMPLE'                          => __( 'Einfach', 'immopress' ),

            // heatingType
            'SELF_CONTAINED_CENTRAL_HEATING' => __( 'Etagenheizung', 'immopress' ),
            'STOVE_HEATING'                      => __( 'Ofenheizung', 'immopress' ),
            'CENTRAL_HEATING'                 => __( 'Zentralheizung', 'immopress' ),
            // -- you'll need the query param "usenewenergysourceenev2014values=true"
            'COMBINED_HEAT_AND_POWER_PLANT'     => __( 'Blockheizkraftwerk', 'immopress' ),
            'ELECTRIC_HEATING'                 => __( 'Elektro-Heizung', 'immopress' ),
            'DISTRICT_HEATING'                 => __( 'Fernwärme', 'immopress' ),
            'FLOOR_HEATING'                      => __( 'Fußbodenheizung', 'immopress' ),
            'GAS_HEATING'                      => __( 'Gas-Heizung)', 'immopress' ),
            'WOOD_PELLET_HEATING'             => __( 'Holz-Pelletheizung', 'immopress' ),
            'NIGHT_STORAGE_HEATER'             => __( 'Nachtspeicherofen', 'immopress' ),
            'OIL_HEATING'                      => __( 'Öl-Heizung', 'immopress' ),
            'SOLAR_HEATING'                      => __( 'Solar-Heizung', 'immopress' ),
            'HEAT_PUMP '                      => __( 'Wärmepumpe', 'immopress' ),

            // firingTypes
            'GEOTHERMAL'                     => __( 'Erdwärme', 'immopress' ),
            'SOLAR_HEATING'                 => __( 'Solar', 'immopress' ),
            'PELLET_HEATING'                 => __( 'Pelletheizung', 'immopress' ),
            'GAS'                              => __( 'Gas', 'immopress' ),
            'OIL'                              => __( 'Öl', 'immopress' ),
            // 'DISTRICT_HEATING'             => __( 'Fernwärme', 'immopress' ),
            'ELECTRICITY'                     => __( 'Strom', 'immopress' ),
            'COAL'                              => __( 'Kohle', 'immopress' ),

            //energyCertificateAvailability
            'AVAILABLE'                         => __( 'liegt vor', 'immopress' ),

            // buildingEnergyRatingType
            'ENERGY_REQUIRED'                 => __( 'Bedarfsausweis', 'immopress' ),
            'ENERGY_CONSUMPTION'             => __( 'Verbrauchsausweis', 'immopress' ),

            // commercializationType
            'BUY'             => __( 'Kauf', 'immopress' ),
            'RENT'             => __( 'Miete', 'immopress' ),

            //officeRentDurations
            'WEEKLY'             => __( 'wöchentlich', 'immopress' ),
            'MONTHLY'             => __( 'monatlich', 'immopress' ),
            'YEARLY'             => __( 'jährlich', 'immopress' ),
            'LONG_TERM'             => __( 'langfristig', 'immopress' ),

        ),

        'Store' => array(

            // base information
            'YES'                              => __( 'ja', 'immopress' ),
            'NO'                              => __( 'nein', 'immopress' ),
            'NO_INFORMATION'                 => __( 'keine Angabe', 'immopress' ),
            'NOT_APPLICABLE'                 => __( 'keine Angabe', 'immopress' ),
            'NEGOTIABLE'                     => __( 'nach Vereinbarung', 'immopress' ),
            'BY_APPOINTMENT'                 => __( 'nach Absprache', 'immopress' ),
            'true'                              => __( 'ja', 'immopress' ),
            'false'                              => __( 'nein', 'immopress' ),

            // storeType
            'SHOWROOM_SPACE'                 => __( 'Ausstellungsfläche', 'immopress' ),
            'SHOPPING_CENTRE'                 => __( 'Einkaufszentrum', 'immopress' ),
            'FACTORY_OUTLET'                 => __( 'Factory Outlet', 'immopress' ),
            'DEPARTMENT_STORE'                 => __( 'Kaufhaus', 'immopress' ),
            'KIOSK'                             => __( 'Kiosk', 'immopress' ),
            'STORE'                             => __( 'Laden', 'immopress' ),
            'SELF_SERVICE_MARKET'             => __( 'SB-Geschäft', 'immopress' ),
            'SALES_AREA'                     => __( 'Verkaufsfläche', 'immopress' ),
            'SALES_HALL'                     => __( 'Verkaufshalle', 'immopress' ),

            // locationClassificationType
            'CLASSIFICATION_A'                 => __( 'A-Lage', 'immopress' ),
            'CLASSIFICATION_B'                 => __( 'B-Lage', 'immopress' ),
            // 'SHOPPING_CENTRE'             => __( 'Einkaufszentrum', 'immopress' ),

            // supplyType
            'DIRECT_APPROACH'                 => __( 'Direkter Zugang', 'immopress' ),
            'NO_DIRECT_APPROACH'             => __( 'kein direkter Zugang', 'immopress' ),
            'CAR_APPROACH'                     => __( 'PKW-Zufahrt', 'immopress' ),
            'APPROACH_TO_THE_FRONT'             => __( 'von Vorne', 'immopress' ),
            'APPROACH_TO_THE_BACK'             => __( 'von Hinten', 'immopress' ),
            'FULL_TIME'                         => __( 'Ganztägig', 'immopress' ),
            'FORENOON'                         => __( 'Vormittags', 'immopress' ),

            // flooringType
            'CONCRETE'                          => __( 'Beton', 'immopress' ),
            'EPOXY_RESIN'                      => __( 'Epoxidharz', 'immopress' ),
            'TILES'                              => __( 'Fliesen', 'immopress' ),
            'PLANKS'                          => __( 'Dielen', 'immopress' ),
            'LAMINATE'                          => __( 'Laminat', 'immopress' ),
            'PARQUET'                          => __( 'Parkett', 'immopress' ),
            'PVC'                              => __( 'PVC', 'immopress' ),
            'CARPET'                          => __( 'Teppichboden', 'immopress' ),
            'ANTISTATIC_FLOOR'                  => __( 'Teppichboden (Antistatisch)', 'immopress' ),
            'OFFICE_CARPET'                      => __( 'Teppichfliesen (Stuhlrollenfest)', 'immopress' ),
            'STONE'                              => __( 'Stein', 'immopress' ),
            'CUSTOMIZABLE'                      => __( 'nach Wunsch', 'immopress' ),
            'WITHOUT'                          => __( 'ohne Bodenbelag', 'immopress' ),

            // condition
            'FIRST_TIME_USE'                 => __( 'Erstbezug', 'immopress' ),
            'FIRST_TIME_USE_AFTER_REFURBISHMENT' => __( 'Erstbezug nach Sanierung', 'immopress' ),
            'MINT_CONDITION'                 => __( 'Neuwertig', 'immopress' ),
            'REFURBISHED'                     => __( 'Saniert', 'immopress' ),
            'MODERNIZED'                     => __( 'Modernisiert', 'immopress' ),
            'FULLY_RENOVATED'                 => __( 'Vollständig renoviert', 'immopress' ),
            'WELL_KEPT'                          => __( 'Gepflegt', 'immopress' ),
            'NEED_OF_RENOVATION'             => __( 'Renovierungsbedürftig', 'immopress' ),
            // 'NEGOTIABLE'                     => __( 'Nach Vereinbarung', 'immopress' ),
            'RIPE_FOR_DEMOLITION'             => __( 'Abbruchreif', 'immopress' ),

            // interiorQuality
            'LUXURY'                          => __( 'luxuriös', 'immopress' ),
            'SOPHISTICATED'                      => __( 'gehoben', 'immopress' ),
            'NORMAL'                          => __( 'normal', 'immopress' ),
            'SIMPLE'                          => __( 'einfach', 'immopress' ),

            // heatingType
            'SELF_CONTAINED_CENTRAL_HEATING' => __( 'Etagenheizung', 'immopress' ),
            'STOVE_HEATING'                      => __( 'Ofenheizung', 'immopress' ),
            'CENTRAL_HEATING'                 => __( 'Zentralheizung', 'immopress' ),
            // -- you'll need the query param "usenewenergysourceenev2014values=true"
            'COMBINED_HEAT_AND_POWER_PLANT'     => __( 'Blockheizkraftwerk', 'immopress' ),
            'ELECTRIC_HEATING'                 => __( 'Elektro-Heizung', 'immopress' ),
            'DISTRICT_HEATING'                 => __( 'Fernwärme', 'immopress' ),
            'FLOOR_HEATING'                      => __( 'Fußbodenheizung', 'immopress' ),
            'GAS_HEATING'                      => __( 'Gas-Heizung)', 'immopress' ),
            'WOOD_PELLET_HEATING'             => __( 'Holz-Pelletheizung', 'immopress' ),
            'NIGHT_STORAGE_HEATER'             => __( 'Nachtspeicherofen', 'immopress' ),
            'OIL_HEATING'                      => __( 'Öl-Heizung', 'immopress' ),
            'SOLAR_HEATING'                      => __( 'Solar-Heizung', 'immopress' ),
            'HEAT_PUMP'                      => __( 'Wärmepumpe', 'immopress' ),

            // firingTypes
            'GEOTHERMAL'                     => __( 'Erdwärme', 'immopress' ),
            'SOLAR_HEATING'                 => __( 'Solarheizung', 'immopress' ),
            'PELLET_HEATING'                 => __( 'Pelletheizung', 'immopress' ),
            'GAS'                              => __( 'Gas', 'immopress' ),
            'OIL'                              => __( 'Öl', 'immopress' ),
            // 'DISTRICT_HEATING'             => __( 'Fernwärme', 'immopress' ),
            'ELECTRICITY'                     => __( 'Strom', 'immopress' ),
            'COAL'                              => __( 'Kohle', 'immopress' ),

            // buildingEnergyRatingType
            'ENERGY_REQUIRED'                 => __( 'Bedarfsausweis', 'immopress' ),
            'ENERGY_CONSUMPTION'             => __( 'Verbrauchsausweis', 'immopress' ),

            // commercializationType
            'BUY'             => __( 'Kauf', 'immopress' ),
            'RENT'             => __( 'Miete', 'immopress' ),

            //energyCertificateAvailability
            'AVAILABLE'                         => __( 'liegt vor', 'immopress' )

        ),

        'Gastronomy' => array(

            // base information
            'YES'                              => __( 'ja', 'immopress' ),
            'NO'                              => __( 'nein', 'immopress' ),
            'NO_INFORMATION'                 => __( 'keine Angabe', 'immopress' ),
            'NOT_APPLICABLE'                 => __( 'keine Angabe', 'immopress' ),
            'NEGOTIABLE'                     => __( 'nach Vereinbarung', 'immopress' ),
            'BY_APPOINTMENT'                 => __( 'nach Absprache', 'immopress' ),
            'true'                              => __( 'ja', 'immopress' ),
            'false'                              => __( 'nein', 'immopress' ),

            // gastronomyType
            'BAR_LOUNGE'                     => __( 'Bar/Lounge', 'immopress' ),
            'CAFE'                             => __( 'Café', 'immopress' ),
            'CLUB_DISCO'                     => __( 'Club/Disko', 'immopress' ),
            'GUESTS_HOUSE'                     => __( 'Gästehaus', 'immopress' ),
            'TAVERN'                         => __( 'Gasthaus', 'immopress' ),
            'HOTEL'                             => __( 'Hotel', 'immopress' ),
            'HOTEL_RESIDENCE'                 => __( 'Hotelanwesen', 'immopress' ),
            'HOTEL_GARNI'                     => __( 'Hotel Garni', 'immopress' ),
            'PENSION'                         => __( 'Pension', 'immopress' ),
            'RESTAURANT'                     => __( 'Restaurant', 'immopress' ),
            'BUNGALOW'                         => __( 'Ferienbungalow', 'immopress' ),

            // flooringType
            'CONCRETE'                          => __( 'Beton', 'immopress' ),
            'EPOXY_RESIN'                      => __( 'Epoxidharz', 'immopress' ),
            'TILES'                              => __( 'Fliesen', 'immopress' ),
            'PLANKS'                          => __( 'Dielen', 'immopress' ),
            'LAMINATE'                          => __( 'Laminat', 'immopress' ),
            'PARQUET'                          => __( 'Parkett', 'immopress' ),
            'PVC'                              => __( 'PVC', 'immopress' ),
            'CARPET'                          => __( 'Teppichboden', 'immopress' ),
            'ANTISTATIC_FLOOR'                  => __( 'Teppichboden (Antistatisch)', 'immopress' ),
            'OFFICE_CARPET'                      => __( 'Teppichfliesen (Stuhlrollenfest)', 'immopress' ),
            'STONE'                              => __( 'Stein', 'immopress' ),
            'CUSTOMIZABLE'                      => __( 'nach Wunsch', 'immopress' ),
            'WITHOUT'                          => __( 'ohne Bodenbelag', 'immopress' ),

            // condition
            'FIRST_TIME_USE'                 => __( 'Erstbezug', 'immopress' ),
            'FIRST_TIME_USE_AFTER_REFURBISHMENT' => __( 'Erstbezug nach Sanierung', 'immopress' ),
            'MINT_CONDITION'                 => __( 'Neuwertig', 'immopress' ),
            'REFURBISHED'                     => __( 'Saniert', 'immopress' ),
            'MODERNIZED'                     => __( 'Modernisiert', 'immopress' ),
            'FULLY_RENOVATED'                 => __( 'Vollständig renoviert', 'immopress' ),
            'WELL_KEPT'                          => __( 'Gepflegt', 'immopress' ),
            'NEED_OF_RENOVATION'             => __( 'Renovierungsbedürftig', 'immopress' ),
            // 'NEGOTIABLE'                     => __( 'Nach Vereinbarung', 'immopress' ),
            'RIPE_FOR_DEMOLITION'             => __( 'Abbruchreif', 'immopress' ),

            // interiorQuality
            'LUXURY'                          => __( 'luxuriös', 'immopress' ),
            'SOPHISTICATED'                      => __( 'gehoben', 'immopress' ),
            'NORMAL'                          => __( 'normal', 'immopress' ),
            'SIMPLE'                          => __( 'einfach', 'immopress' ),

            // heatingType
            'SELF_CONTAINED_CENTRAL_HEATING' => __( 'Etagenheizung', 'immopress' ),
            'STOVE_HEATING'                      => __( 'Ofenheizung', 'immopress' ),
            'CENTRAL_HEATING'                 => __( 'Zentralheizung', 'immopress' ),
            // -- you'll need the query param "usenewenergysourceenev2014values=true"
            'COMBINED_HEAT_AND_POWER_PLANT'     => __( 'Blockheizkraftwerk', 'immopress' ),
            'ELECTRIC_HEATING'                 => __( 'Elektro-Heizung', 'immopress' ),
            'DISTRICT_HEATING'                 => __( 'Fernwärme', 'immopress' ),
            'FLOOR_HEATING'                      => __( 'Fußbodenheizung', 'immopress' ),
            'GAS_HEATING'                      => __( 'Gas-Heizung)', 'immopress' ),
            'WOOD_PELLET_HEATING'             => __( 'Holz-Pelletheizung', 'immopress' ),
            'NIGHT_STORAGE_HEATER'             => __( 'Nachtspeicherofen', 'immopress' ),
            'OIL_HEATING'                      => __( 'Öl-Heizung', 'immopress' ),
            'SOLAR_HEATING'                      => __( 'Solar-Heizung', 'immopress' ),
            'HEAT_PUMP'                      => __( 'Wärmepumpe', 'immopress' ),

            // firingTypes
            'GEOTHERMAL'                     => __( 'Erdwärme', 'immopress' ),
            'SOLAR_HEATING'                 => __( 'Solarheizung', 'immopress' ),
            'PELLET_HEATING'                 => __( 'Pelletheizung', 'immopress' ),
            'GAS'                              => __( 'Gas', 'immopress' ),
            'OIL'                              => __( 'Öl', 'immopress' ),
            // 'DISTRICT_HEATING'             => __( 'Fernwärme', 'immopress' ),
            'ELECTRICITY'                     => __( 'Strom', 'immopress' ),
            'COAL'                              => __( 'Kohle', 'immopress' ),

            // buildingEnergyRatingType
            'ENERGY_REQUIRED'                 => __( 'Bedarfsausweis', 'immopress' ),
            'ENERGY_CONSUMPTION'             => __( 'Energieverbrauchskennwert', 'immopress' ),

            // commercializationType
            'BUY'                             => __( 'Kauf', 'immopress' ),
            'RENT'                             => __( 'Miete', 'immopress' ),
            'LEASE'                             => __( 'Leasing', 'immopress' )

        ),

        'Industry' => array(

            // base information
            'YES'                              => __( 'ja', 'immopress' ),
            'NO'                              => __( 'nein', 'immopress' ),
            'NO_INFORMATION'                 => __( 'keine Angabe', 'immopress' ),
            'NOT_APPLICABLE'                 => __( 'keine Angabe', 'immopress' ),
            'NEGOTIABLE'                     => __( 'nach Vereinbarung', 'immopress' ),
            'BY_APPOINTMENT'                 => __( 'nach Absprache', 'immopress' ),
            'true'                              => __( 'ja', 'immopress' ),
            'false'                              => __( 'nein', 'immopress' ),

            // industryType
            'SHOWROOM_SPACE'                 => __( 'Ausstellungsfläche', 'immopress' ),
            'HALL'                             => __( 'Halle', 'immopress' ),
            'HIGH_LACK_STORAGE'                 => __( 'Hochregallager', 'immopress' ),
            'INDUSTRY_HALL'                     => __( 'Industriehalle', 'immopress' ),
            'INDUSTRY_HALL_WITH_OPEN_AREA'     => __( 'Industriehalle mit Freifläche', 'immopress' ),
            'COLD_STORAGE'                     => __( 'Kühlhaus', 'immopress' ),
            'MULTIDECK_CABINET_STORAGE'         => __( 'Kühlregallager', 'immopress' ),
            'STORAGE_WITH_OPEN_AREA'         => __( 'Lager mit Freifläche', 'immopress' ),
            'STORAGE_AREA'                     => __( 'Lagerfläche', 'immopress' ),
            'STORAGE_HALL'                     => __( 'Lagerhalle', 'immopress' ),
            'SERVICE_AREA'                     => __( 'Servicefläche', 'immopress' ),
            'SHIPPING_STORAGE'                 => __( 'Speditionslager', 'immopress' ),
            'REPAIR_SHOP'                     => __( 'Werkstatt', 'immopress' ),

            // flooringType
            'CONCRETE'                          => __( 'Beton', 'immopress' ),
            'EPOXY_RESIN'                      => __( 'Epoxidharz', 'immopress' ),
            'TILES'                              => __( 'Fliesen', 'immopress' ),
            'PLANKS'                          => __( 'Dielen', 'immopress' ),
            'LAMINATE'                          => __( 'Laminat', 'immopress' ),
            'PARQUET'                          => __( 'Parkett', 'immopress' ),
            'PVC'                              => __( 'PVC', 'immopress' ),
            'CARPET'                          => __( 'Teppichboden', 'immopress' ),
            'ANTISTATIC_FLOOR'                  => __( 'Teppichboden (Antistatisch)', 'immopress' ),
            'OFFICE_CARPET'                      => __( 'Teppichfliesen (Stuhlrollenfest)', 'immopress' ),
            'STONE'                              => __( 'Stein', 'immopress' ),
            'CUSTOMIZABLE'                      => __( 'nach Wunsch', 'immopress' ),
            'WITHOUT'                          => __( 'ohne Bodenbelag', 'immopress' ),

            // condition
            'FIRST_TIME_USE'                 => __( 'Erstbezug', 'immopress' ),
            'FIRST_TIME_USE_AFTER_REFURBISHMENT' => __( 'Erstbezug nach Sanierung', 'immopress' ),
            'MINT_CONDITION'                 => __( 'Neuwertig', 'immopress' ),
            'REFURBISHED'                     => __( 'Saniert', 'immopress' ),
            'MODERNIZED'                     => __( 'Modernisiert', 'immopress' ),
            'FULLY_RENOVATED'                 => __( 'Vollständig renoviert', 'immopress' ),
            'WELL_KEPT'                          => __( 'Gepflegt', 'immopress' ),
            'NEED_OF_RENOVATION'             => __( 'Renovierungsbedürftig', 'immopress' ),
            // 'NEGOTIABLE'                     => __( 'Nach Vereinbarung', 'immopress' ),
            'RIPE_FOR_DEMOLITION'             => __( 'Abbruchreif', 'immopress' ),

            // interiorQuality
            'LUXURY'                          => __( 'luxuriös', 'immopress' ),
            'SOPHISTICATED'                      => __( 'gehoben', 'immopress' ),
            'NORMAL'                          => __( 'normal', 'immopress' ),
            'SIMPLE'                          => __( 'einfach', 'immopress' ),

            // heatingType
            'SELF_CONTAINED_CENTRAL_HEATING' => __( 'Etagenheizung', 'immopress' ),
            'STOVE_HEATING'                      => __( 'Ofenheizung', 'immopress' ),
            'CENTRAL_HEATING'                 => __( 'Zentralheizung', 'immopress' ),
            // -- you'll need the query param "usenewenergysourceenev2014values=true"
            'COMBINED_HEAT_AND_POWER_PLANT'     => __( 'Blockheizkraftwerk', 'immopress' ),
            'ELECTRIC_HEATING'                 => __( 'Elektro-Heizung', 'immopress' ),
            'DISTRICT_HEATING'                 => __( 'Fernwärme', 'immopress' ),
            'FLOOR_HEATING'                      => __( 'Fußbodenheizung', 'immopress' ),
            'GAS_HEATING'                      => __( 'Gas-Heizung)', 'immopress' ),
            'WOOD_PELLET_HEATING'             => __( 'Holz-Pelletheizung', 'immopress' ),
            'NIGHT_STORAGE_HEATER'             => __( 'Nachtspeicherofen', 'immopress' ),
            'OIL_HEATING'                      => __( 'Öl-Heizung', 'immopress' ),
            'SOLAR_HEATING'                      => __( 'Solar-Heizung', 'immopress' ),
            'HEAT_PUMP'                      => __( 'Wärmepumpe', 'immopress' ),

            // firingTypes
            'GEOTHERMAL'                     => __( 'Erdwärme', 'immopress' ),
            'SOLAR_HEATING'                 => __( 'Solarheizung', 'immopress' ),
            'PELLET_HEATING'                 => __( 'Pelletheizung', 'immopress' ),
            'GAS'                              => __( 'Gas', 'immopress' ),
            'OIL'                              => __( 'Öl', 'immopress' ),
            // 'DISTRICT_HEATING'             => __( 'Fernwärme', 'immopress' ),
            'ELECTRICITY'                     => __( 'Strom', 'immopress' ),
            'COAL'                              => __( 'Kohle', 'immopress' ),

            // buildingEnergyRatingType
            'ENERGY_REQUIRED'                 => __( 'Bedarfsausweis', 'immopress' ),
            'ENERGY_CONSUMPTION'             => __( 'Energieverbrauchskennwert', 'immopress' ),

            // commercializationType
            'BUY'                             => __( 'Kauf', 'immopress' ),
            'RENT'                             => __( 'Miete', 'immopress' )

        ),

        'TradeSite' => array(

            // base information
            'YES'                              => __( 'ja', 'immopress' ),
            'NO'                              => __( 'nein', 'immopress' ),
            'NO_INFORMATION'                 => __( 'keine Angabe', 'immopress' ),
            'NOT_APPLICABLE'                 => __( 'keine Angabe', 'immopress' ),
            'NEGOTIABLE'                     => __( 'nach Vereinbarung', 'immopress' ),
            'BY_APPOINTMENT'                 => __( 'nach Absprache', 'immopress' ),
            'true'                              => __( 'ja', 'immopress' ),
            'false'                              => __( 'nein', 'immopress' ),

            // recommendedUseTypes
            'FARMLAND'                          => __( 'Ackerland', 'immopress' ),
            'FUTURE_DEVELOPMENT_LAND'         => __( 'Bauerwartungsland', 'immopress' ),
            'MOORAGE'                          => __( 'Bootsstände', 'immopress' ),
            'OFFICE'                          => __( 'Büro', 'immopress' ),
            'CAMPING'                          => __( 'Camping', 'immopress' ),
            'BIG_STORE'                          => __( 'Einzelgroßhandel', 'immopress' ),
            'LITTLE_STORE'                     => __( 'Einzelkleinhandel', 'immopress' ),
            'GARAGE'                          => __( 'Garagen', 'immopress' ),
            'GARDEN'                          => __( 'Garten', 'immopress' ),
            'GASTRONOMY'                     => __( 'Gastronomie', 'immopress' ),
            'BUSINESS'                          => __( 'Gewerbe', 'immopress' ),
            'HOTEL'                              => __( 'Hotel', 'immopress' ),
            'INDUSTRY'                          => __( 'Industrie', 'immopress' ),
            'NO_DEVELOPMENT'                 => __( 'keine Bebauung', 'immopress' ),
            'SMALL_BUSINESS'                 => __( 'Kleingewerbe', 'immopress' ),
            'STOCK'                              => __( 'Lager', 'immopress' ),
            'ORCHARD'                          => __( 'Obstgarten', 'immopress' ),
            'CAR_PARK'                          => __( 'Parkhaus', 'immopress' ),
            'PRODUCTION'                     => __( 'Produktion', 'immopress' ),
            'PARKING_SPACE'                     => __( 'Stellplätze', 'immopress' ),
            'FORREST'                          => __( 'Wald', 'immopress' ),

            // utilizationTradeSite
            'LEISURE'                          => __( 'Freizeit', 'immopress' ),
            'AGRICULTURE_FORESTRY'             => __( 'Land-/Forstwirtschaft', 'immopress' ),
            'TRADE'                              => __( 'Gewerbe', 'immopress' ),

            // siteDevelopmentType
            'DEVELOPED'                         => __( 'Erschlossen', 'immopress' ),
            'DEVELOPED_PARTIALLY'             => __( 'Teilerschlossen', 'immopress' ),
            'NOT_DEVELOPED'                     => __( 'Unerschlossen', 'immopress' ),

            // siteConstructibleType
            'CONSTRUCTIONPLAN'                 => __( 'Bebauung nach Bebauungsplan', 'immopress' ),
            'NEIGHBOURCONSTRUCTION'             => __( 'Nachbarbebauung', 'immopress' ),
            'EXTERNALAREA'                     => __( 'Aussengebiet', 'immopress' ),

            // commercializationType
            'BUY'                             => __( 'Kauf', 'immopress' ),
            'RENT'                             => __( 'Miete', 'immopress' ),
            'LEASE'                             => __( 'Leasing', 'immopress' ),
            'LEASEHOLD'                         => __( 'Pacht', 'immopress' ),


        ),

        'SpecialPurpose' => array(

            // base information
            'YES'                              => __( 'ja', 'immopress' ),
            'NO'                              => __( 'nein', 'immopress' ),
            'NO_INFORMATION'                 => __( 'keine Angabe', 'immopress' ),
            'NOT_APPLICABLE'                 => __( 'keine Angabe', 'immopress' ),
            'NEGOTIABLE'                     => __( 'nach Vereinbarung', 'immopress' ),
            'BY_APPOINTMENT'                 => __( 'nach Absprache', 'immopress' ),
            'true'                              => __( 'ja', 'immopress' ),
            'false'                              => __( 'nein', 'immopress' ),

            // specialPurposePropertyType
            'RESIDENCE'                         => __( 'Anwesen', 'immopress' ),
            'FARM'                             => __( 'Bauernhof', 'immopress' ),
            'HORSE_FARM'                     => __( 'Reiterhof', 'immopress' ),
            'VINEYARD'                         => __( 'Weingut', 'immopress' ),
            'REPAIR_SHOP'                     => __( 'Werkstatt', 'immopress' ),
            'LEISURE_FACILITY'                 => __( 'Freizeitanlage', 'immopress' ),
            'INDUSTRIAL_AREA'                 => __( 'Gewerbefläche', 'immopress' ),
            'SPECIAL_ESTATE'                 => __( 'Spezialobjekt', 'immopress' ),
            'COMMERCIAL_CENTRE'                 => __( 'Gewerbepark', 'immopress' ),

            // flooringType
            'CONCRETE'                          => __( 'Beton', 'immopress' ),
            'EPOXY_RESIN'                      => __( 'Epoxidharz', 'immopress' ),
            'TILES'                              => __( 'Fliesen', 'immopress' ),
            'PLANKS'                          => __( 'Dielen', 'immopress' ),
            'LAMINATE'                          => __( 'Laminat', 'immopress' ),
            'PARQUET'                          => __( 'Parkett', 'immopress' ),
            'PVC'                              => __( 'PVC', 'immopress' ),
            'CARPET'                          => __( 'Teppichboden', 'immopress' ),
            'ANTISTATIC_FLOOR'                  => __( 'Teppichboden (Antistatisch)', 'immopress' ),
            'OFFICE_CARPET'                      => __( 'Teppichfliesen (Stuhlrollenfest)', 'immopress' ),
            'STONE'                              => __( 'Stein', 'immopress' ),
            'CUSTOMIZABLE'                      => __( 'nach Wunsch', 'immopress' ),
            'WITHOUT'                          => __( 'ohne Bodenbelag', 'immopress' ),

            // condition
            'FIRST_TIME_USE'                 => __( 'Erstbezug', 'immopress' ),
            'FIRST_TIME_USE_AFTER_REFURBISHMENT' => __( 'Erstbezug nach Sanierung', 'immopress' ),
            'MINT_CONDITION'                 => __( 'Neuwertig', 'immopress' ),
            'REFURBISHED'                     => __( 'Saniert', 'immopress' ),
            'MODERNIZED'                     => __( 'Modernisiert', 'immopress' ),
            'FULLY_RENOVATED'                 => __( 'Vollständig renoviert', 'immopress' ),
            'WELL_KEPT'                          => __( 'Gepflegt', 'immopress' ),
            'NEED_OF_RENOVATION'             => __( 'Renovierungsbedürftig', 'immopress' ),
            // 'NEGOTIABLE'                     => __( 'Nach Vereinbarung', 'immopress' ),
            'RIPE_FOR_DEMOLITION'             => __( 'Abbruchreif', 'immopress' ),

            // interiorQuality
            'LUXURY'                          => __( 'luxuriös', 'immopress' ),
            'SOPHISTICATED'                      => __( 'gehoben', 'immopress' ),
            'NORMAL'                          => __( 'normal', 'immopress' ),
            'SIMPLE'                          => __( 'einfach', 'immopress' ),

            // heatingType
            'SELF_CONTAINED_CENTRAL_HEATING' => __( 'Etagenheizung', 'immopress' ),
            'STOVE_HEATING'                      => __( 'Ofenheizung', 'immopress' ),
            'CENTRAL_HEATING'                 => __( 'Zentralheizung', 'immopress' ),
            // -- you'll need the query param "usenewenergysourceenev2014values=true"
            'COMBINED_HEAT_AND_POWER_PLANT'     => __( 'Blockheizkraftwerk', 'immopress' ),
            'ELECTRIC_HEATING'                 => __( 'Elektro-Heizung', 'immopress' ),
            'DISTRICT_HEATING'                 => __( 'Fernwärme', 'immopress' ),
            'FLOOR_HEATING'                      => __( 'Fußbodenheizung', 'immopress' ),
            'GAS_HEATING'                      => __( 'Gas-Heizung)', 'immopress' ),
            'WOOD_PELLET_HEATING'             => __( 'Holz-Pelletheizung', 'immopress' ),
            'NIGHT_STORAGE_HEATER'             => __( 'Nachtspeicherofen', 'immopress' ),
            'OIL_HEATING'                      => __( 'Öl-Heizung', 'immopress' ),
            'SOLAR_HEATING'                      => __( 'Solar-Heizung', 'immopress' ),
            'HEAT_PUMP'                      => __( 'Wärmepumpe', 'immopress' ),

            // firingTypes
            'GEOTHERMAL'                     => __( 'Erdwärme', 'immopress' ),
            'SOLAR_HEATING'                 => __( 'Solarheizung', 'immopress' ),
            'PELLET_HEATING'                 => __( 'Pelletheizung', 'immopress' ),
            'GAS'                              => __( 'Gas', 'immopress' ),
            'OIL'                              => __( 'Öl', 'immopress' ),
            // 'DISTRICT_HEATING'             => __( 'Fernwärme', 'immopress' ),
            'ELECTRICITY'                     => __( 'Strom', 'immopress' ),
            'COAL'                              => __( 'Kohle', 'immopress' ),

            // buildingEnergyRatingType
            'ENERGY_REQUIRED'                 => __( 'Bedarfsausweis', 'immopress' ),
            'ENERGY_CONSUMPTION'             => __( 'Energieverbrauchskennwert', 'immopress' ),

        ),


        // SONSTIGE

        'Investment' => array(
        ),

        'HouseType' => array(
        ),

        'CompulsoryAuction' => array(
        ),

        'AssistedLiving' => array(
        ),

        'SeniorCare' => array(
        ),

        'ShortTermAccommodation' => array(
        ),
    );
});
