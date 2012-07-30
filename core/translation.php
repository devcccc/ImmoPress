<?php
	
$this->fields = array(
	'apartmentType'                      => __( 'Wohnungstyp', 'immopress'),
	'assistedLiving'                     => __( 'Seniorengerechtes Wohnen', 'immopress'),
	'balcony'                            => __( 'Balkon/ Terasse', 'immopress'),
	'baseRent'                           => __( 'Kaltmiete', 'immopress'),
	'buildingEnergyRatingType'           => __( 'Energieausweistyp', 'immopress'),
	'buildingType'                       => __( 'Haustyp', 'immopress'),
	'builtInKitchen'                     => __( 'Einbauküche', 'immopress'),
	'cellar'                             => __( 'Keller', 'immopress'),
	'certificateOfEligibilityNeeded'     => __( 'Wohnberechtigungsschein erforderlich', 'immopress'),
	'condition'                          => __( 'Objektzustand', 'immopress'),
	'constructionYear'                   => __( 'Baujahr', 'immopress'),
	'courtage'                           => __( 'Provisionshöhe', 'immopress'),
	'courtageNote'                       => __( 'Provisionshinweis', 'immopress'),
	'deposit'                            => __( 'Kaution oder Genossenschaftsanteile', 'immopress'),
	'descriptionNote'                    => __( 'Objektbeschreibung', 'immopress'),
	'energyConsumptionContainsWarmWater' => __( 'Energieverbrauch für Warmwasser enthalten', 'immopress'),
	'firingType'                         => __( 'Befeuerungsart', 'immopress' ),
	'floor'                              => __( 'Etage', 'immopress'),
	'freeFrom'                           => __( 'Verfügbar ab', 'immopress'),
	'furnishingNote'                     => __( 'Ausstattung', 'immopress'),
	'garden'                             => __( 'Garten/ -mitbenutzung', 'immopress'),
	'guestToilet'                        => __( 'Gäste-WC', 'immopress'),
	'handicappedAccessible'              => __( 'Barrierefrei', 'immopress'),
	'hasCourtage'                        => __( 'Provision', 'immopress'),
	'heatingCosts'                       => __( 'Heizkosten', 'immopress'),
	'heatingCostsInServiceCharge'        => __( 'Heizkosten sind in Nebenkosten enthalten', 'immopress'),
	'heatingType'                        => __( 'Heizungsart', 'immopress'),
	'interiorQuality'                    => __( 'Qualität der Ausstattung', 'immopress'),
	'lastRefurbishment'                  => __( 'Letzte Modernisierung/ Sanierung', 'immopress'),
	'lift'                               => __( 'Personenaufzug', 'immopress'),
	'livingSpace'                        => __( 'Wohnfläche ca.', 'immopress'),
	'locationNote'                       => __( 'Lage', 'immopress'),
	'lodgerFlat'                         => __( 'Anliegerwohnung', 'immopress'),
	'monument'                           => __( 'Denkmalschutzobjekt', 'immopress'),
	'numberOfBathRooms'                  => __( 'Anzahl Badezimmer', 'immopress'),
	'numberOfBedRooms'                   => __( 'Anzahl Schlafzimmer ', 'immopress'),
	'numberOfFloors'                     => __( 'Etagenzahl', 'immopress'),
	'numberOfParkingSpaces'              => __( 'Anzahl Garage/ Stellplatz', 'immopress'),
	'numberOfRooms'                      => __( 'Zimmer', 'immopress'),
	'otherNote'                          => __( 'Sonstiges', 'immopress'),
	'parkingSpace'                       => __( 'Garage/ Stellplatz', 'immopress'),
	'parkingSpacePrice'                  => __( 'Garage/ Stellplatz- Kaufpreis', 'immopress'),
	'parkingSpaceType'                   => __( 'Garage/ Stellplatz', 'immopress'),
	'petsAllowed'                        => __( 'Haustiere', 'immopress'),
	'price'                              => __( 'Preis', 'immopress'),
	'purchasePrice'                      => __( 'Kaufpreis', 'immopress'),
	'rentalIncome'                       => __( 'Mieteinnahmen pro Monat', 'immopress'),
	'rented'                             => __( 'Vermietet', 'immopress'),
	'serviceCharge'                      => __( 'Nebenkosten', 'immopress'),
	'summerResidencePractical'           => __( 'Als Ferienhaus geeignet', 'immopress'),
	'thermalCharacteristic'              => __( 'Energieverbrauchskennwert', 'immopress'),
	'totalRent'                          => __( 'Gesamtmiete', 'immopress'),
	'usableFloorSpace'                   => __( 'Nutzfläche ca.', 'immopress' )
);
	
$this->values = array(
	
	// apartmentType: Wohnungstyp
	'NO_INFORMATION'      => __( 'Keine Angabe', 'immopress'),
	'ROOF_STOREY'         => __( 'Dachgeschoss', 'immopress'),
	'LOFT'                => __( 'Loft', 'immopress'),
	'MAISONETTE'          => __( 'Maisonette', 'immopress'),
	'PENTHOUSE'           => __( 'Penthouse', 'immopress'),
	'TERRACED_FLAT'       => __( 'Terrassenwohnung', 'immopress'),
	'GROUND_FLOOR'        => __( 'Erdgeschosswohnung', 'immopress'),
	'APARTMENT'           => __( 'Etagenwohnung', 'immopress'),
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
	
	// heatingType: Heizungsart
	'SELF_CONTAINED_CENTRAL_HEATING' => __( 'Etagenheizung', 'immopress'),
	'STOVE_HEATING'                  => __( 'Ofenheizung', 'immopress'),
	'CENTRAL_HEATING'                => __( 'Zentralheizung', 'immopress'),
	
	// firingType: Befeuerungsart
	'GEOTHERMAL'       => __( 'Erdwärme', 'immopress'),
	'SOLAR_HEATING'    => __( 'Solarheizung', 'immopress'),
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
	'OUTSIDE'            => __( 'Außenstellplatz', 'immopress'),
	'CARPORT'            => __( 'Carport', 'immopress'),
	'DUPLEX'             => __( 'Duplex', 'immopress'),
	'CAR_PARK'           => __( 'Parkhaus', 'immopress'),
	'UNDERGROUND_GARAGE' => __( 'Tiefgarage', 'immopress'),
	
	// buildingEnergyRatingType: Energieausweistyp
	'ENERGY_REQUIRED'    => __( 'Endenergiebedarf', 'immopress'),
	'ENERGY_CONSUMPTION' => __( 'Energieverbrauchskennwert', 'immopress'),
	
	// allgemein
	'true'           => __( 'ja', 'immopress'),
	'YES'            => __( 'ja', 'immopress'),
	'false'          => __( 'nein', 'immopress'),
	'NO'             => __( 'nein', 'immopress'),
	'NOT_APPLICABLE' => __( 'nein', 'immopress'),
	'PROVISIONSFREI' => __( 'Provisionsfrei', 'immopress' )
);

$this->terms = array(

	// Mieten
	'rent' => array(
	
		'APARTMENT_RENT'           => __( 'Wohnungen', 'immopress'),
		'HOUSE_RENT'               => __( 'Häuser', 'immopress'),
		'LIVING_RENT_SITE'         => __( 'Grundstücke', 'immopress'),
		'GARAGE_RENT'              => __( 'Garagen / Stellplätze', 'immopress'),
		'SHORT_TERM_ACCOMMODATION' => __( 'Wohnen auf Zeit', 'immopress'),
		'FLAT_SHARE_ROOM'          => __( 'WGs', 'immopress'),
		'ASSISTED_LIVING'          => __( 'Betreutes Wohnen', 'immopress'),
		'SENIOR_CARE'              => __( 'Pflegeheime', 'immopress')
	),
		
	// Kaufen
	'buy' => array(
	
		'APARTMENT_BUY'      => __( 'Wohnungen', 'immopress'),
		'HOUSE_BUY'          => __( 'Häuser', 'immopress'),
		'LIVING_BUY_SITE'    => __( 'Grundstücke', 'immopress'),
		'GARAGE_BUY'         => __( 'Garagen / Stellplätze', 'immopress'),
		'INVESTMENT'         => __( 'Anlageobjekte', 'immopress'),
		'COMPULSORY_AUCTION' => __( 'Zwangsversteigerungen', 'immopress'),
		'HOUSE_TYPE'         => __( 'Fertig- & Massivhäuser', 'immopress')
	)
);
	
	?>