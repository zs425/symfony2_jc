<?php

namespace JetCharters\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormError;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;

class OperatorUserType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	$countryArr = array(                        	"AF"=> "AFGHANISTAN", "AL"=> "ALBANIA (REPUBLIC OF)", "DZ"=> "ALGERIA", "AS"=> "AMERICAN SAMOA", "AO"=> "ANGOLA, REPUBLIC OF", "AI"=> "ANGUILLA IS.", "AQ"=> "ANTARCTICA", "AG"=> "ANTIGUA &amp; BARBUDA", "AR"=> "ARGENTINA", "AM"=> "ARMENIA (REPUBLIC OF)", "AW"=> "ARUBA IS.", "AU"=> "AUSTRALIA", "AT"=> "AUSTRIA", "AZ"=> "AZERBAIJAN REPUBLIC", "BS"=> "BAHAMAS", "BH"=> "BAHRAIN", "BD"=> "BANGLADESH, PEOPLES REP.", "BB"=> "BARBADOS", "BY"=> "BELARUS, REPUBLIC OF", "BE"=> "BELGIUM", "BZ"=> "BELIZE", "BJ"=> "BENIN, PEOPLE'S REPUBLIC", "BM"=> "BERMUDA", "BT"=> "BHUTAN, KINGDOM OF", "BO"=> "BOLIVIA (REPUBLIC OF)", "BA"=> "BOSNIA &amp; HERCEGOVINA", "BW"=> "BOTSWANA, REPUBLIC OF", "BR"=> "BRAZIL", "VG"=> "BRITISH VIRGIN ISLANDS", "BN"=> "BRUNEI DARUSSALAM", "BG"=> "BULGARIA, REPUBLIC OF", "BF"=> "BURKINA FASO", "BI"=> "BURUNDI, REPUBLIC OF", "KH"=> "CAMBODIA, KINGDOM OF", "CM"=> "CAMEROON, REPUBLIC OF", "CA"=> "CANADA", "CV"=> "CAPE VERDE, REPUBLIC OF", 
                        	"KY"=> "CAYMAN IS.", "CF"=> "CENTRAL AFRICAN REP.", "TD"=> "CHAD, REPUBLIC OF", "CL"=> "CHILE", "CN"=> "CHINA, PEOPLE'S REP. OF", "CX"=> "CHRISTMAS IS.", "CC"=> "COCOS (KEELING) IS.", "CO"=> "COLOMBIA, REPUBLIC OF","KM"=> "COMOROS IS.", "CD"=> "CONGO, DEMOCRATIC REP. OF", "CG"=> "CONGO, REPUBLIC OF", "CK"=> "COOK IS.", "CR"=> "COSTA RICA", "CI"=> "COTE D'IVOIRE", 
				"COUN"=> "COUNTRY_NAME", "HR"=> "CROATIA", "CU"=> "CUBA, REPUBLIC OF", "CY"=> "CYPRUS", "CZ"=> "CZECH REPUBLIC", "DK"=> "DENMARK", "DJ"=> "DJIBOUTI, REPUBLIC OF", "DM"=> "DOMINICA, COMMONWEALTH OF", "DO"=> "DOMINICAN REPUBLIC", "EC"=> "ECUADOR", "EG"=> "EGYPT,", "SV"=> "EL SALVADOR, REPUBLIC OF", "GQ"=> "EQUATORIAL GUINEA, REP.", "ER"=> "ERITREA (REPUBLIC OF)", "EE"=> "ESTONIA", "ET"=> "ETHIOPIA", "FK"=> "FALKLAND IS.", "FO"=> "FAROE ISLANDS", "FJ"=> "FIJI IS., REPUBLIC OF", "FI"=> "FINLAND", "FR"=> "FRANCE", "GF"=> "FRENCH GUIANA", 
                        	"PF"=> "FRENCH POLYNESIA", "GA"=> "GABON", "GM"=> "GAMBIA,", "DE"=> "GERMANY", "GH"=> "GHANA, REPUBLIC OF", 
				"GI"=> "GIBRALTAR", "GR"=> "GREECE", "GL"=> "GREENLAND", "GD"=> "GRENADA IS.","GP"=> "GUADELOUPE", "GU"=> "GUAM", 
                        
                        	"GT"=> "GUATEMALA, REPUBLIC OF","GN"=> "GUINEA, REPUBLIC OF", "GW"=> "GUINEA-BISSAU, REP. OF", "GY"=> "GUYANA", "HT"=> "HAITI, REPUBLIC OF", "HN"=> "HONDURAS, REPUBLIC OF", 
                        
                        	"HK"=> "HONG KONG", "HU"=> "HUNGARY, REPUBLIC OF", "IS"=> "ICELAND, REPUBLIC OF", "IN"=> "INDIA", "ID"=> "INDONESIA", 
                        
                        	"IR"=> "IRAN, ISLAMIC REPUBLIC OF", "IQ"=> "IRAQ, REPUBLIC OF", "IE"=> "IRELAND", "IL"=> "ISRAEL", "IT"=> "ITALY", "JM"=> "JAMAICA", "JP"=> "JAPAN", "JOH"=> "JOHNSTON ATOLL", "JO"=> "JORDAN", "KZ"=> "KAZAKHSTAN, REPUBLIC OF", 
                        
                        	"KE"=> "KENYA, REPUBLIC OF", "KI"=> "KIRIBATI, REPUBLIC OF", "KW"=> "KUWAIT", "KG"=> "KYRGYZSTAN", "LA"=> "LAO PEOPLE'S DEM. REP.", "LV"=> "LATVIA", 
                        
                        	"LB"=> "LEBANON, REPUBLIC OF", "LS"=> "LESOTHO, KINGDOM OF", "LR"=> "LIBERIA", "LY"=> "LIBYAN ARAB JAMAHIRIYA", "LT"=> "LITHUANIA, REPUBLIC OF", "LU"=> "LUXEMBOURG, GRAND DUCHY", 
                        
                        	"MO"=> "MACAU", "MK"=> "MACEDONIA", "MG"=> "MADAGASCAR, DEM. REP. OF", "MW"=> "MALAWI, REPUBLIC OF", "MY"=> "MALAYSIA", "MV"=> "MALDIVES (REP. OF)", "ML"=> "MALI, REPUBLIC OF", "MT"=> "MALTA", 
                        
                        	"MH"=> "MARSHALL IS., REPUBLIC OF", "MQ"=> "MARTINIQUE IS.", "MR"=> "MAURITANIA, ISLAMIC REP.", "MU"=> "MAURITIUS IS.", "YT"=> "MAYOTTE IS.", "MX"=> "MEXICO", "FM"=> "MICRONESIA, FED. STATES", 
                        
                        	"MID"=> "MIDWAY ATOLL", "MD"=> "MOLDOVA, REPUBLIC OF", "MN"=> "MONGOLIA", "MA"=> "MOROCCO", "MZ"=> "MOZAMBIQUE, REPUBLIC OF", 
                        
                        	"MM"=> "MYANMAR (BURMA)", "KP"=> "N. KOREA, DEM PEOPLE REP", 
                        
                        	"NA"=> "NAMIBIA", "NR"=> "NAURU IS., REPUBLIC OF", "NP"=> "NEPAL, KINGDOM OF", "AN"=> "NETHERLANDS ANTILLES ", 
                        
                        	"NL"=> "NETHERLANDS, KINGDOM OF", "NC"=> "NEW CALEDONIA IS.", "NZ"=> "NEW ZEALAND", 
                        
                        	"NI"=> "NICARAGUA, REPUBLIC OF","NE"=> "NIGER, REPUBLIC OF", "NG"=> "NIGERIA", "NF"=> "NORFOLK IS., TERRITORY OF", "MP"=> "NORTHERN MARIANA IS.", "NO"=> "NORWAY", 
                        
                        	"OM"=> "OMAN", "PK"=> "PAKISTAN", "PW"=> "PALAU, REPUBLIC OF", "PA"=> "PANAMA, REPUBLIC OF", "PG"=> "PAPUA NEW GUINEA", 
                        
                        	"PAR"=> "PARACEL IS.", "PY"=> "PARAGUAY, REPUBLIC OF", "PE"=> "PERU", "PH"=> "PHILIPPINES", "PL"=> "POLAND, REPUBLIC OF", 
                        
                        	"PT"=> "PORTUGAL", "PR"=> "PUERTO RICO", "QA"=> "QATAR", "GE"=> "REPUBLIC OF GEORGIA", "RE"=> "REUNION IS.", 
                        
                        	"RO"=> "ROMANIA", "RU"=> "RUSSIAN FEDERATION", "RW"=> "RWANDA, REPUBLIC OF", "KR"=> "S KOREA (REP. OF)", "LC"=> "SAINT LUCIA", 
                        
                        	"WS"=> "SAMOA", "ST"=> "SAO TOME &amp; PRformStepINCIPE", "SA"=> "SAUDI ARABIA", "SN"=> "SENEGAL, REPUBLIC OF", "CS"=> "SERBIA AND MONTENEGRO", 
                        
                        	"SC"=> "SEYCHELLES, REPUBLIC OF", 
                        
                        	"SL"=> "SIERRA LEONE, REPUBLIC OF", 
                        
                        	"SG"=> "SINGAPORE", 
                        
                        	"SK"=> "SLOVAKIA", 
                        
                        	"SI"=> "SLOVENIA, REPUBLIC OF", 
                        
                        	"SB"=> "SOLOMON IS.", 
                        
                        	"SO"=> "SOMALIA", 
                        
                        	"ZA"=> "SOUTH AFRICA", 
                        
                        	"ES"=> "SPAIN", 
                        
                        	"SPR"=> "SPRATLY IS.", 
                        
                        	"LK"=> "SRI LANKA -DEM SOC REP OF", 
                        
                        	"KN"=> "ST KITTS &amp; NEVIS IS.", 
                        
                        	"PM"=> "ST PIERRE &amp; MIQUELON", 
                        
                        	"VC"=> "ST. VINCENT &amp; GRENADINES", 
                        
                        	"SD"=> "SUDAN, REPUBLIC OF", 
                        
                        	"SR"=> "SURINAME, REPUBLIC OF", 
                        
                        	"SJ"=> "SVALBARD &amp; JAN MAYEN IS.", 
                        
                        	"SZ"=> "SWAZILAND, KINGDOM OF", 
                        
                        	"SE"=> "SWEDEN", 
                        
                        	"CH"=> "SWITZERLAND", 
                        
                        	"SY"=> "SYRIAN ARAB REPUBLIC", 
                        
                        	"TW"=> "TAIWAN, REPUBLIC OF CHINA", 
                        
                        	"TJ"=> "TAJIKISTAN (REP. OF)", 
                        
                        	"TZ"=> "TANZANIA (UNITED REP. OF)", 
                        
                        	"TH"=> "THAILAND", 
                        
                        	"TL"=> "TIMOR-LESTE", 
                        
                        	"TG"=> "TOGO", 
                        
                        	"TO"=> "TONGA, KINGDOM OF", 
                        
                        	"TT"=> "TRINIDAD &amp; TOBAGO, REP OF", 
                        
                        	"TN"=> "TUNISIA, REPUBLIC OF", 
                        
                        	"TR"=> "TURKEY", 
                        
                        	"TM"=> "TURKMENISTAN", 
                        
                        	"TC"=> "TURKS &amp; CAICOS ISLANDS", 
                        
                        	"VI"=> "U.S. VIRGIN IS.", 
                        
                        	"UG"=> "UGANDA", 
                        
                        	"UA"=> "UKRAINE", 
                        
                        	"AE"=> "UNITED ARAB EMIRATES", 
                        
                        	"GB"=> "UNITED KINGDOM", 
                        
                        	"US"=> "UNITED STATES", 
                        
                        	"UY"=> "URUGUAY, REPUBLIC OF", 
                        
                        	"UZ"=> "UZBEKISTAN, REPUBLIC OF", 
                        
                        	"VU"=> "VANUATU IS., REPUBLIC OF", 
                        
                        	"VE"=> "VENEZUELA", 
                        
                        	"VN"=> "VIETNAM, SOCIALIST REP.", "WAK"=> "WAKE IS.", "WF"=> "WALLIS &amp; FUTUNA IS.", "WEB"=> "WEST BANK", "EH"=> "WESTERN SAHARA", "YE"=> "YEMEN, REPUBLIC OF", "ZM"=> "ZAMBIA, REPUBLIC OF", "ZW"=> "ZIMBABWE");
    
    
	 // VALIDATING NON MAPPED FIELD Symfony 2.1.2 way (and forward)
        /** @var \closure $myExtraFieldValidator **/
        $myExtraFieldValidator = function(FormEvent $event){
            $form = $event->getForm();
            $myExtraField = $form->get('companyName')->getData();
            if (empty($myExtraField)) {
              $form['companyName']->addError(new FormError("Please enter company name"));
            }
        };
        // adding the validator to the FormBuilderInterface
        $builder->addEventListener(FormEvents::POST_BIND, $myExtraFieldValidator);
        
        if (isset($options['formStep']) && $options['formStep']=='step2') {
	    
	    if (isset($options['registeredUserData']) && $options['registeredUserData']!=false) {
		$options['data'] = $options['registeredUserData'];
	    }
	    
	    $builder
		->add('firstName', 'text', array('data' => isset($options['data']) && $options['data']->getFirstName() ? $options['data']->getFirstName() : false ) )
		->add('lastName', 'text', array('data' => isset($options['data']) && $options['data']->getLastName() ? $options['data']->getLastName() : false ) )
		->add('address1', 'text', array('data' => isset($options['data']) && $options['data']->getAddress1() ? $options['data']->getAddress1() : false ) )
		->add('address2', 'text', array('data' => isset($options['data']) && $options['data']->getAddress2() ? $options['data']->getAddress2() : false ) )
		->add('city', 'text', array('data' => isset($options['data']) && $options['data']->getCity() ? $options['data']->getCity() : false ) )
		->add('state', 'text', array('data' => isset($options['data']) && $options['data']->getState() ? $options['data']->getState() : false ) )
		->add('country', 'choice', array('choices'   => $countryArr, 'data' => isset($options['data']) && $options['data']->getCountry()!='' ? $options['data']->getCountry() : 'US', 'required' => true))
		->add('zip', 'text', array('data' => isset($options['data']) && $options['data']->getZip() ? $options['data']->getZip() : false ) )
		;
        } else {
	    
	    $builder
		->add('companyName', 'text' , array("mapped" => false, 'required' => true))
		->add('website', 'text' , array("mapped" => false, 'required' => false))
		->add('certificate', 'text' , array("mapped" => false, 'required' => false))
		->add('firstName')
		->add('lastName')
		->add('position')
		->add('address1')
		->add('address2')
		->add('city')
		->add('state')
		->add('country', 'choice', array('choices'   => $countryArr, 'data' => isset($options['data']) && $options['data']->getCountry()!='' ? $options['data']->getCountry() : 'US', 'required' => true))
		->add('zip')
		->add('phone')
		->add('email', 'email', array(
		    'constraints' => array(
			new NotBlank(array('message' => 'This email should not be blank.') ) ,
			new Email(array('message' => 'This email should be valid.') ) 
		    )
		))
		->add('password', 'repeated', array(
		    'type' => 'password',
		    'invalid_message' => 'The password fields must match.',
		    'options' => array('attr' => array('class' => 'password-field')),
		    'required' => true,
		    'first_options'  => array('label' => 'Password'),
		    'second_options' => array('label' => 'Confirm Password'),
		    'constraints' => array(
			new NotBlank(array('message' => 'The password should not be blank.') ), 
			new Length(array('min'=>1, 'minMessage' => 'Password must be 6 characters or longer.'))
		    )
		))
		->add('captcha', 'captcha' , array(
			'width' => 250,
			'height' => 40,
			'length' => 6,
			'invalid_message' => "Invalid Captcha.",
			'quality' => '100', 
			'humanity' => 1,
			'reload' => true,
			'as_url' => true
		    )
		)
		;
	}
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JetCharters\AppBundle\Entity\OperatorUser',
            'formStep'	=> false,
            'registeredUserData' => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'jetcharters_appbundle_operator';
    }
}
