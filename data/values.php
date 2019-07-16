<?php

// Mit Sternchen markierte Zeilen sind von der Schreibweise her mit der Webseite
// von immobilienscout24 abgegelichen

return call_user_func(function () {
    return array(
        // apartmentType: Wohnungstyp
        'NO_INFORMATION'      => __( 'Keine Angabe', 'immopress'),
        'ROOF_STOREY'         => __( 'Dachgeschoss', 'immopress'),
        'LOFT'                => __( 'Loft', 'immopress'),
        'MAISONETTE'          => __( 'Maisonette', 'immopress'),
        'PENTHOUSE'           => __( 'Penthouse', 'immopress'),
        'TERRACED_FLAT'       => __( 'Terrassenwohnung', 'immopress'),
        'GROUND_FLOOR'        => __( 'Erdgeschosswohnung', 'immopress'),
        'APARTMENT'           => __( 'Etagenwohnung', 'immopress'),                  // *
        'RAISED_GROUND_FLOOR' => __( 'Hochparterre', 'immopress'),
        'HALF_BASEMENT'       => __( 'Souterrain', 'immopress'),
        'OTHER'               => __( 'Sonstige', 'immopress'),

        // buildingType: Haustyp
        'SINGLE_FAMILY_HOUSE' => __( 'Einfamilienhaus (freistehend)', 'immopress'),
        'MID_TERRACE_HOUSE'   => __( 'Reihenmittelhaus', 'immopress'),
        'END_TERRACE_HOUSE'   => __( 'Reiheneckhaus', 'immopress'),
        'MULTI_FAMILY_HOUSE'  => __( 'Mehrfamilienhaus', 'immopress'),
        'BUNGALOW'            => __( 'Bungalow', 'immopress'),
        'FARMHOUSE'           => __( 'Bauernhaus', 'immopress'),
        'SEMIDETACHED_HOUSE'  => __( 'Doppelhaushälfte', 'immopress'),
        'VILLA'               => __( 'Villa', 'immopress'),
        'CASTLE_MANOR_HOUSE'  => __( 'Burg/Schloss', 'immopress'),
        'SPECIAL_REAL_ESTATE' => __( 'Besondere Immobilie', 'immopress'),

        // officeType: Bürotyp
        'LOFT'                           => __( 'Loft', 'immopress' ),
        'STUDIO'                         => __( 'Atelier', 'immopress' ),
        'OFFICE'                         => __( 'Büro', 'immopress' ),                 // *
        'OFFICE_FLOOR'                   => __( 'Büroetage', 'immopress' ),
        'OFFICE_BUILDING'                => __( 'Bürohaus', 'immopress' ),             // *
        'OFFICE_CENTRE'                  => __( 'Bürozentrum', 'immopress' ),
        'OFFICE_STORAGE_BUILDING'        => __( 'Büro-/ Lagergebäude ', 'immopress' ), // *
        'SURGERY'                        => __( 'Praxis', 'immopress' ),
        'SURGERY_FLOOR'                  => __( 'Praxisetage', 'immopress' ),
        'SURGERY_BUILDING'               => __( 'Praxishaus', 'immopress' ),
        'COMMERCIAL_CENTRE'              => __( 'Gewerbezentrum', 'immopress' ),
        'LIVING_AND_COMMERCIAL_BUILDING' => __( 'Wohn- und Geschäftsgebäude', 'immopress' ),
        'OFFICE_AND_COMMERCIAL_BUILDING' => __( 'Büro- und Geschäftsgebäude', 'immopress' ),

        // storeType
        'SHOWROOM_SPACE'      => __( 'Ausstellungsfläche', 'immopress' ),
        'SHOPPING_CENTRE'     => __( 'Einkaufszentrum', 'immopress' ),
        'FACTORY_OUTLET'      => __( 'Factory-Outlet', 'immopress' ),
        'DEPARTMENT_STORE'    => __( 'Kaufhaus', 'immopress' ),
        'KIOSK'               => __( 'Kiosk', 'immopress' ),
        'STORE'               => __( 'Laden', 'immopress' ),    // *
        'SELF_SERVICE_MARKET' => __( 'SB-Markt', 'immopress' ),
        'SALES_HALL'          => __( 'Verkaufshalle', 'immopress' ),

        // gastronomyType
        'BAR_LOUNGE'      => __( 'Barbetrieb', 'immopress' ),
        'CAFE'            => __( 'Café', 'immopress' ),
        'CLUB_DISCO'      => __( 'Diskothek', 'immopress' ),
        'GUESTS_HOUSE'    => __( 'Gästehaus', 'immopress' ),
        'TAVERN'          => __( 'Lokal', 'immopress' ),
        'HOTEL'           => __( 'Hotel', 'immopress' ),
        'HOTEL_RESIDENCE' => __( 'Hotelanwesen', 'immopress' ),
        'HOTEL_GARNI'     => __( 'Hotel garni', 'immopress' ),
        'PENSION'         => __( 'Pension', 'immopress' ),
        'RESTAURANT'      => __( 'Restaurant', 'immopress' ),
        /* @todo key already exists (see buildingType) */
        //'BUNGALOW'        => __( 'Ferienbungalow', 'immopress' ),



        // heatingType: Heizungsart
        'SELF_CONTAINED_CENTRAL_HEATING' => __( 'Etagenheizung', 'immopress'),
        'STOVE_HEATING'                  => __( 'Ofenheizung', 'immopress'),
        'CENTRAL_HEATING'                => __( 'Zentralheizung', 'immopress'),

        // firingType: Befeuerungsart
        'GEOTHERMAL'       => __( 'Erdwärme', 'immopress'),
        'SOLAR_HEATING'    => __( 'Solar', 'immopress'),                    // *
        'PELLET_HEATING'   => __( 'Pelletheizung', 'immopress'),
        'GAS'              => __( 'Gas', 'immopress'),
        'OIL'              => __( 'Öl', 'immopress'),
        'DISTRICT_HEATING' => __( 'Fernwärme', 'immopress'),
        'ELECTRICITY'      => __( 'Strom', 'immopress'),
        'COAL'             => __( 'Kohle', 'immopress'),

        // condition: Objektzustand
        'FIRST_TIME_USE'                     => __( 'Erstbezug', 'immopress'),
        'FIRST_TIME_USE_AFTER_REFURBISHMENT' => __( 'Erstbezug nach Sanierung', 'immopress'),
        'MINT_CONDITION'                     => __( 'Neuwertig', 'immopress'),
        'REFURBISHED'                        => __( 'Saniert', 'immopress'),
        'MODERNIZED'                         => __( 'Modernisiert', 'immopress'),
        'FULLY_RENOVATED'                    => __( 'Vollständig renoviert', 'immopress'),
        'WELL_KEPT'                          => __( 'Gepflegt', 'immopress'),
        'NEED_OF_RENOVATION'                 => __( 'Renovierungsbedürftig', 'immopress'),
        'NEGOTIABLE'                         => __( 'Nach Vereinbarung', 'immopress'),
        'RIPE_FOR_DEMOLITION'                => __( 'Abbruchreif', 'immopress'),

        // interiorQuality: Qualität der Ausstattung
        'LUXURY'        => __( 'Luxus', 'immopress'),
        'SOPHISTICATED' => __( 'Gehoben', 'immopress'),
        'NORMAL'        => __( 'Normal', 'immopress'),
        'SIMPLE'        => __( 'Einfach', 'immopress'),

        // parkingSpaceType: Parkmöglichkeiten
        'GARAGE'             => __( 'Garage', 'immopress'),
        'STREET_PARKING'     => __( 'Außenstellplatz', 'immopress'),
        'CARPORT'            => __( 'Carport', 'immopress'),
        'DUPLEX'             => __( 'Duplex', 'immopress'),
        'CAR_PARK'           => __( 'Parkhaus', 'immopress'),
        'UNDERGROUND_GARAGE' => __( 'Tiefgarage', 'immopress'),
        'OUTSIDE'            => __( 'Außenstellplatz', 'immopress'),

        // constructionPhase: Bauphase
        'COMPLETED' => __( 'Fertiggestellt', 'immopress'),
        'PROJECTED' => __( 'in Planung', 'immopress'),
        'UNDER_CONSTRUCTION' => __( 'im Bau', 'immopress'),

        // buildingEnergyRatingType: Energieausweistyp
        'ENERGY_REQUIRED'    => __( 'Bedarfsausweis', 'immopress'),
        'ENERGY_CONSUMPTION' => __( 'Verbrauchsausweis', 'immopress'),

        // flooringType: Bodenart
        'TILES'             => __( 'Fliesen', 'immopress'),
        'PLANKS'            => __( 'Bretter', 'immopress'),
        'LAMINATE'          => __( 'Laminat', 'immopress'),
        'PARQUET'           => __( 'Parkett', 'immopress'),
        'PVC'               => __( 'PVC', 'immopress'),
        'CARPET'            => __( 'Teppich', 'immopress'),
        'ANTISTATICFLOOR'   => __( 'Antistatischer Boden', 'immopress'),
        'OFFICECARPET'      => __( 'Büro-Teppich', 'immopress'),
        'STONE'             => __( 'Stein', 'immopress'),
        'CUSTOMIZABLE'      => __( 'Anpassbar', 'immopress'),
        'WITHOUT'           => __( 'Ohne', 'immopress'),

        // allgemein
        'true'           => __( 'ja', 'immopress'),
        'YES'            => __( 'ja', 'immopress'),
        'false'          => __( 'nein', 'immopress'),
        'NO'             => __( 'nein', 'immopress'),
        'NOT_APPLICABLE' => __( 'nein', 'immopress'),
        'PROVISIONSFREI' => __( 'Provisionsfrei', 'immopress' )
    );
});
