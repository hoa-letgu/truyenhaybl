<?php

function baseRange($start, $end, $step, $fromRight)
{
    $index = -1;
    $length = max(ceil(($end - $start) / ($step || 1)), 0);
    $result = [];

    while ($length--) {
        $result[$fromRight ? $length : ++$index] = $start;
        $start += $step;
    }

    return $result;
}

function toFinite($value)
{

    $INFINITY = 0;
    $MAX_INTEGER = 1.7976931348623157e+308;

    if (!$value) {
        return $value === 0 ? $value : 0;
    }
    $value = toNumber($value);
    if ($value === $INFINITY || $value === -$INFINITY) {
        $sign = ($value < 0 ? -1 : 1);
        return $sign * $MAX_INTEGER;
    }
    return $value === $value ? $value : 0;
}

function toNumber($value)
{
    return intval($value);
}

function createRange($start, $end = false, $step = false)
{
    $start = toFinite($start);
    if (!$end) {
        $end = $start;
        $start = 0;
    } else {
        $end = toFinite($end);
    }
    $step = !$step ? ($start < $end ? 1 : -1) : toFinite($step);
    return baseRange($start, $end, $step, false);
}

function getColsInGroup($slices)
{
    $length = count($slices);
    if ($length === 1) {
        return 1;
    }

    for ($i = 0; $i < $length; $i++) {
        if (!isset($check)) {
            $check = $slices[$i]['y'];
        }

        if ($check !== $slices[$i]['y']) {
            return $i;
        }
    }

    return $i;
}

function getGroup($slices)
{
    $data = [
        'slices' => count($slices),
        'cols' => getColsInGroup($slices),
    ];
    $data['rows'] = count($slices) / $data['cols'];
    $data['x'] = $slices[0]['x'];
    $data['y'] = $slices[0]['y'];

    return $data;
}

function seedRand($seedrandom, $min, $max)
{
    return floor($seedrandom * ($max - $min + 1)) + $min;
}

function unShuffle($arr)
{
    $seed = [0.07111011901119368, 0.6523642568980361, 0.8556215202976776, 0.6511056873131681, 0.1549193570060695, 0.02772100046371799, 0.7881642220185402, 0.9709137321602865, 0.833592760902111, 0.9376166802783577, 0.46348165360770516, 0.28961524981910136, 0.601906818412754, 0.5718417668102903, 0.4794191854669235, 0.43014669785688686, 0.39355902313716973, 0.31695968685605286, 0.41096063777017683, 0.9449023370351405, 0.6216642571362234, 0.3822803351457682, 0.9172228846071235, 0.22438000192390972, 0.7852064758586188, 0.6797508786580209, 0.027011339248996426, 0.8166342960600814, 0.6488097091387824, 0.7594063839436281, 0.8330055347073857, 0.9997771514945973, 0.5841918829795004, 0.4673366554216477, 0.533767293335615, 0.1755034686178113, 0.7568109534475361, 0.5248954028674262, 0.5657560374617402, 0.4739281036292767, 0.5959648853353535, 0.6678640385954702, 0.3895311386093252, 0.614748986182347, 0.8793802507354164, 0.5007214742802466, 0.6281138411600052, 0.5210935310835341, 0.7369930180184608, 0.4779333376660129, 0.9629854469552784, 0.008269092498443585, 0.6225700354642199, 0.8998277045643976, 0.10587416249118438, 0.42159185608427535, 0.591595398219154, 0.08845958987576566, 0.5925506591290731, 0.0762883394915308, 0.5754485715424192, 0.411016870430837, 0.2977379638432149, 0.12869914698244253, 0.8205601912046706, 0.7571595034152745, 0.4199772606928631, 0.21560633092989429, 0.02150647725713757, 0.6477307461486859, 0.5032935241366889, 0.7540526535085486, 0.6860240605921689, 0.23210508791918252, 0.7086255141898928, 0.7225624749176337, 0.40496087854541435, 0.34472287277641567, 0.2486607446154227, 0.19105263816267729, 0.8492489711526049, 0.06086424433015007, 0.2521404926291133, 0.9658854377995439, 0.4179016274883946, 0.26946579438174073, 0.24181909475696356, 0.8733176667950927, 0.5030655879824982, 0.7959011768022618, 0.15208949299874125, 0.25751111253314535, 0.4732269647771015, 0.62991213003233, 0.98788398652872, 0.017742188588008398, 0.7153290320296162, 0.5619086927168612, 0.5821816821166875, 0.4841570345694411, 0.5195519259664847, 0.43424014114449083, 0.56652970091926, 0.8036683132915643, 0.2662470796179931, 0.6197365299800371, 0.29292143655505726, 0.06978708692614746, 0.07582326543017881, 0.23375760758956665, 0.48987446901434833, 0.6524496635308793, 0.4644393834715788, 0.9622911001565343, 0.5385385085806385, 0.43996565730148274, 0.0808226402357532, 0.8440050242591833, 0.7537899282968465, 0.8515505922371142, 0.2900429133430486, 0.3393186594021416, 0.11034406534698797, 0.6032868348185334, 0.7163476597702322, 0.1457031644720734, 0.08621723776792906, 0.007591128975242649, 0.5829648930476281, 0.18179712949521104, 0.40397373034213363, 0.7563171346027303, 0.6066543956850906, 0.0014932153739464957, 0.6311327354894004, 0.6154492628162871, 0.10925578357278697, 0.5912589998819212, 0.18489199648191149, 0.05427164260869568, 0.8873575501372813, 0.9297260673505602, 0.6130217284289591, 0.711687633627078, 0.4443966863176196, 0.36686727828695476, 0.6055839397903917, 0.3916678726459724, 0.16337218516539057, 0.1988411101489442, 0.7147165948490415, 0.11960061052884273, 0.9238873241691018, 0.14188422045375532, 0.21660249172606746, 0.03703077113763814, 0.604490193933467, 0.24715399844911223, 0.546801708412117, 0.4639213860968276, 0.06948522798849048, 0.715298426188618, 0.5263651019157909, 0.8178057806739971, 0.3044331761646762, 0.5154458368392572, 0.067979467861606, 0.9813371716472178, 0.9182661340224408, 0.7586808408874094, 0.2021182229917234, 0.8181099454224402, 0.8405913655827814, 0.34575649430521477, 0.6055965528674154, 0.23587511763939753, 0.615955979939302, 0.7693662383415971, 0.8365807583407445, 0.6464295251235833, 0.48605041857366116, 0.7289842109432737, 0.5810356481181073, 0.7590098621183612, 0.5665730607655444, 0.7250482777325338, 0.9258746801802834, 0.3488591332544349, 0.35510885363196015, 0.8351354810410819, 0.48362604539407916, 0.33829872716906234, 0.48452116742638024, 0.7225320447342306, 0.05620613860551805, 0.15442424078233574, 0.6431751006030132, 0.03171359772037499, 0.9932127554970398, 0.7953747317928789, 0.6431729139240844, 0.23087228422203285, 0.05476431535183692, 0.07228507172830288, 0.7936092484976245, 0.04485875147384159, 0.9523635483098224, 0.39209673230683184, 0.022733788589664725, 0.9983954069919021, 0.14033217473827503, 0.5263507534723559, 0.3279435998332631, 0.5917851450437469, 0.0837917984893831, 0.8155864714863889, 0.09224046784717496, 0.9083451775829167, 0.6039043038875116, 0.5232335845290665, 0.551111167666258, 0.39234498853886435, 0.49563086875963014, 0.7624613345322633, 0.08349507139133898, 0.2931899240498012, 0.3961424498904062, 0.7188066806343208, 0.7351457783356515, 0.973584260896508, 0.9729467542336927, 0.3141598017520814, 0.44471228386540274, 0.39851266826405995, 0.41074002446568036, 0.752209191933184, 0.268845781417172, 0.14267245423786215, 0.39675720785453056, 0.8214638089952015, 0.21926214503096494, 0.41998409650423557, 0.5123255206683767, 0.45760267335262955, 0.7260574819585702, 0.408070523754437, 0.8206981308577763, 0.9686249072011548, 0.7673834842684933, 0.9303429396853085, 0.03847340270169132, 0.5140259361449774, 0.4026394335088033, 0.24387511777780738, 0.7500470938490119, 0.32503804772886136, 0.9867352802629623, 0.9955800317271489, 0.9633833300329067, 0.4534668669323215, 0.5729174336308107, 0.3422231238171284, 0.3815379378210752, 0.7981642128211696, 0.46181500233458694, 0.1150048109051919, 0.37045574125147884, 0.2604037390941746, 0.6236316743928525, 0.927743943665231, 0.03240963910477546, 0.8721447565719288, 0.4982427737742021, 0.17235726961797046, 0.9725588256749503, 0.8775860610937631, 0.5380760717559127, 0.5822446337118143, 0.7832946269811804, 0.20004896431484384, 0.20559032222380882, 0.19786069343998497, 0.539946625363659, 0.5258065581213054, 0.4358671712904398, 0.3626072119816437, 0.6532004748596795, 0.7728701414357833, 0.20766296697929673, 0.6480420482812039, 0.20453664472304747, 0.02847502318799168, 0.6330807348041679, 0.020468277660704522, 0.642882381675026, 0.7315789499770144, 0.4777818926864997, 0.23760469173216453, 0.35118372868645065, 0.9336350094666859, 0.16085564660677618, 0.41945897841850205, 0.36813515230591526, 0.8462580789092072, 0.5529915203975051, 0.4719050182227753, 0.9537351778323306, 0.4944019958993376, 0.15979336108927078, 0.1632809035952849, 0.2414095107551836, 0.8123284554063266, 0.254727152953226, 0.6928834729924023, 0.20026222017683096, 0.41924612915712944, 0.6648506288145962, 0.4089240270709826, 0.302486122478571, 0.9983155786315064, 0.04349814996164188, 0.8636851606671506, 0.3711080555681092, 0.28825506965357883, 0.5577830190325729, 0.8625097803839369, 0.7632206341990083, 0.9613954313049593, 0.6717827423587674, 0.8365456044072761, 0.827867203333347, 0.4435426193640587, 0.604729478393064, 0.8173719142981073, 0.44998688164229533, 0.6570531257522083, 0.5801133292095093, 0.2892640043481278, 0.8893879746368822, 0.7886548179480443, 0.6388818803246977, 0.22610623760728718, 0.1689356444817254, 0.36758536363580246, 0.17922545081077398, 0.3339044696921669, 0.23797606598639323, 0.5954501501101257, 0.031531617241148696, 0.786479981596845, 0.4477315199816401, 0.06791995768126263, 0.19582829538203494, 0.24373445326283952, 0.003024269430390229, 0.46598695261379774, 0.31610850060992685, 0.3968727968261108, 0.014602189854226556, 0.31505693740269713, 0.02324561671897078, 0.32370432050547876, 0.4682547628970655, 0.49138992895606576, 0.13001639862269923, 0.6570792837883681, 0.14573701866370856, 0.8526240027390855, 0.67048919085319, 0.796853481563983, 0.6554521308519204, 0.5407899737255999, 0.43625231240587065, 0.8607674283839282, 0.11620492587160779, 0.8498699622310539, 0.18994788101198404, 0.274047285122892, 0.6615881214423429, 0.06221790162859328, 0.7892589940337994, 0.8482116063285322, 0.5119484744470919, 0.8504381534017378, 0.6704754813130228, 0.5195943716109314, 0.4809953602047645, 0.20339948758850024, 0.750431464000817, 0.3827785479222158, 0.7240195979706414, 0.2959174761409306, 0.05565816703470292, 0.5866612261023902, 0.029834459349633205, 0.014166078226105504, 0.14226467032719492, 0.27076114901286286, 0.46498716379534144, 0.43129353791284875, 0.37813542135231093, 0.31795257296184715, 0.06290733596603217, 0.23535566201222596, 0.3814657749830972, 0.5898170706285194, 0.02929543701482727, 0.49824941265233597, 0.14335232674896636, 0.7934901329389304, 0.5907856046958757, 0.7989752629747778, 0.43995954471219295, 0.1480028807970523, 0.7414492543729114, 0.8195493007634398, 0.27028542185452714, 0.8581254373108865, 0.16712260545459623, 0.9733596971772202, 0.518122991219557, 0.37119222312489913, 0.04135940604709778, 0.026181839676266905, 0.47823144074472557, 0.5425861051547343, 0.6346876238131358, 0.5677185922841789, 0.6288100370232328, 0.46593297686539065, 0.7485976446176698, 0.42420710017474006, 0.5455053870772465, 0.6311804285161369, 0.19803490353040465, 0.2476754208718016, 0.6504369737734724, 0.49634629857520174, 0.2659767612673108, 0.4487892275283056, 0.05352807509887938, 0.8741734642214507, 0.09766629397545647, 0.0695358547527789, 0.08040329797887556, 0.5860819618534031, 0.3266297696407726, 0.5463215108612448, 0.8151537118015496, 0.23122066011338072, 0.32656393654626, 0.11850544105210942, 0.9943092187859405, 0.7525354581890726, 0.7541710471742569, 0.7850758588880135, 0.11285148461812161, 0.9941005234455518, 0.744575896710154, 0.9138850306817214, 0.014122171346085509, 0.8722824651510037, 0.7348588120690726, 0.2590637078590325, 0.1988303629734809, 0.5745273279987207, 0.7175642267136993, 0.644373454265431, 0.8467564202639352, 0.4267603880547521, 0.8417107749415383, 0.16388628984654022, 0.5311249186350442, 0.049202479590391486, 0.4848128367818669, 0.5898557319688638, 0.5596772094892454, 0.7106358882331385, 0.4051690608674245, 0.5228530873879953, 0.0699560771689627, 0.7391539042438712, 0.063743659466158, 0.983044588680145, 0.12827860816159548, 0.9625951974633317, 0.010892468797455522, 0.36673021594114247, 0.4982942652486156, 0.8027008584286857, 0.8624033342711235, 0.8681382710803949, 0.05992617805682325, 0.41998351477658286, 0.9368462094923444, 0.26770928932164645, 0.7301957708971494, 0.7675239084611435, 0.9899655549706609, 0.1530774495268537, 0.22258911811320634, 0.9846871013042049, 0.3886072571759841, 0.5470814211386623, 0.2773454984814544, 0.2926916485251581, 0.7821107143721723, 0.14696467832356797, 0.8489243750220946, 0.47985586895582, 0.7172525243210492, 0.5728852101008981, 0.28642104799216006, 0.9265952971866048, 0.7460962999091296, 0.6089879912134311, 0.7587607529479277, 0.8593767996920036, 0.7412014065488657, 0.7764988827954089, 0.02261370654743038, 0.2002907094696126, 0.31015334241320297, 0.40150486628426, 0.29071465794162354, 0.4223107668757866, 0.45152309786879685, 0.16027085997394655, 0.3329365993220157, 0.9713585158586652, 0.47638326577409673, 0.8089332248520398, 0.5797169331738382, 0.31316433430933893, 0.24862761977809125, 0.7199546131898905, 0.321742643032828, 0.6408444595923471, 0.4716216768270376, 0.793120976087211, 0.6256517422038419, 0.30703673983709256, 0.7288429594733893, 0.4664623048434222, 0.5617682228860837, 0.7429871211211384, 0.2749126326778262, 0.82609892441833, 0.21415719133768776, 0.643202281871366, 0.31299565767202425, 0.9802817303917095, 0.023219886176477127, 0.9560220586304166, 0.04892053989801382, 0.8261437673623384, 0.31954242296730867, 0.42569481978073137, 0.6324263262757523, 0.6517245537938365, 0.32856243320334805, 0.9783402686778848, 0.671604569976591, 0.2367526936705383, 0.0009095248140861364, 0.7565034274611572, 0.6749870532934285, 0.830264887798334, 0.2286355691473333, 0.7998102492125747, 0.0520331673960241, 0.8567452552461406, 0.43903553779713533, 0.08195724653537134, 0.24319430699245073, 0.827990599446502, 0.30390800941683177, 0.8509230952326511, 0.35740598127825507, 0.48553079225253126, 0.811141482029528, 0.18606303415681832, 0.6786788899358875, 0.09431066518352041, 0.2591083281871261, 0.8468039262008948, 0.09750322693902187, 0.5317913707005505, 0.8601234786799177, 0.744676227513145, 0.18493585881405658, 0.7780679300338671, 0.19089472971189456, 0.6206976652976428, 0.3824194846056642, 0.970255115227767, 0.8367909836161906, 0.92299636202443, 0.8710713130890784, 0.45939274250896733, 0.6677486860530851, 0.18431246961447856, 0.9466827746806964, 0.07550988596581791, 0.0738097556023655, 0.46319791297900836, 0.8409081224966143, 0.5750115278724232, 0.15526378273764274, 0.542249433694448, 0.19662308410684043, 0.9412361653214696, 0.8149072555059421, 0.7042167376317344, 0.18502128092010295, 0.41807827511999757, 0.635680577268587, 0.7023228174602288, 0.03170751294565449, 0.272585520869358, 0.20867951286077072, 0.26292937370035263, 0.23242836057465888, 0.5860662941151944, 0.3465852761434304, 0.5164627955598394, 0.8853921063735598, 0.7353858870276533, 0.24264240193141418, 0.7185614036973303, 0.4738496184191903, 0.9653189102235119, 0.816241532142632, 0.8600784156128067, 0.7837329959104969, 0.13009185949827937, 0.3274450169719234, 0.5310584582395148, 0.9438830984272008, 0.07254018291715078, 0.9622521101909808, 0.9291556987221053, 0.33435909367468974, 0.09345445672918037, 0.8444350581577122, 0.41792969785882206, 0.1413536270145951, 0.21150588334138587, 0.16643605316272567, 0.17855501589092862, 0.8277364857530903, 0.8182132643047355, 0.46740490245852, 0.6783121018366464, 0.5469933895030106, 0.8150749534526986, 0.9029980863197931, 0.39045178290074223, 0.15663607799214826, 0.850101605731446, 0.6955955050304641, 0.7035195378477667, 0.6836334478368258, 0.5426245843718268, 0.8502390765049959, 0.6534147630596024, 0.319593082339247, 0.5206919682791212, 0.9881072188630659, 0.00236220598337779, 0.8331457178979642, 0.22661993023440083, 0.9960490431525088, 0.7428608254065788, 0.3117821992967939, 0.6218274003207274, 0.17667991127745966, 0.965081286060097, 0.5202736628856249, 0.3668651048785323, 0.4876932879880752, 0.812586602833795, 0.09838142883275088, 0.48224154329645896, 0.501070579499563, 0.32321633612672246, 0.6049867081397268, 0.877151180500706, 0.52327580936116, 0.5848445549689254, 0.2341702988432645, 0.3251730883552765, 0.8812083789443568, 0.5711780572919329, 0.5254086631199574, 0.5271161666885779, 0.4722504265390919, 0.572538532777749, 0.2939129373344376, 0.36711139716090935, 0.06769130404664218, 0.1706700846532753, 0.2390146923060534, 0.4338578621098625, 0.30437794250757694, 0.3533968782562269, 0.6420045131345853, 0.329637460645648, 0.1855792211513001, 0.8858840451743306, 0.15207394213094913, 0.06165459682744214, 0.3716193169703603, 0.4001343504022996, 0.5829897729965591, 0.32741594539847024, 0.7713079547394482, 0.761869653067974, 0.6913073392352406, 0.29985992733076944, 0.40205052668144914, 0.5097583118550665, 0.14007811802042416, 0.5067594036540091, 0.9752442296609993, 0.462222684743156, 0.7266551273102301, 0.6866385813864774, 0.013831554305830638, 0.07392401656463989, 0.6006249786240092, 0.40398516256590306, 0.10065154959327634, 0.6991713474580672, 0.7423554309836214, 0.721077159748965, 0.1028681650543864, 0.6693137176074236, 0.00999325620220456, 0.19392842349784462, 0.8828361005845031, 0.5759263351141068, 0.23904325977676738, 0.7388754139869386, 0.25999381490370266, 0.2744020896991533, 0.03836033626918035, 0.49878736938419604, 0.05951283659328312, 0.529390848632436, 0.6604521342107592, 0.9123066776152053, 0.2816182181577375, 0.058391996795779506, 0.9760726928394349, 0.9539904381566844, 0.555542782652541, 0.8306590559149931, 0.12781187461792334, 0.5094103520280254, 0.08544497332419261, 0.22523578903336613, 0.9220646491005023, 0.7836018298910545, 0.6409840810377269, 0.5184821724974503, 0.0061524232795840805, 0.6367658778220352, 0.7180305055835942, 0.6931270320110781, 0.055305971110255585, 0.24323585605791342, 0.45976538452484583, 0.04811093640864845, 0.9128047546815455, 0.6205779921605015, 0.4729250136437686, 0.27024743127213413, 0.47882064216231834, 0.07949227249146115, 0.4051648618881679, 0.24896421084782216, 0.7122503320483164, 0.9225002205154463, 0.4341622853842035, 0.18338350493734562, 0.12285880606013129, 0.7906663027658659, 0.8629627988350322, 0.863054467269578, 0.9033321093186419, 0.10736095296946613, 0.6064128173098454, 0.4405914678730198, 0.1352709081022582, 0.2000284313672164, 0.07000531536534109, 0.4848991787496377, 0.11306552763494243, 0.3326887162516439, 0.46350404769333226, 0.3052479755323425, 0.727590794009647, 0.9911172104832859, 0.8049755824901552, 0.4257865766022365, 0.08493484459474654, 0.990024376194331, 0.5014525865187015, 0.25577966003885994, 0.41027039524522024, 0.7894498978953358, 0.3634169684251383, 0.18017869852257976, 0.17941604459939872, 0.40327463855308515, 0.8651302669677553, 0.25735514869772874, 0.22475166963603802, 0.03521864630959486, 0.6108045400164207, 0.3710656493344284, 0.1191799473538143, 0.3795449255086178, 0.4519263887466298, 0.6852388979423211, 0.09704702174741602, 0.86771093291237, 0.016655227647512056, 0.8423524305315814, 0.5453373117991124, 0.42274807108433393, 0.9577505175745084, 0.6706945895394559, 0.546265956075988, 0.47188057388751703, 0.8099725212671522, 0.5072309549999319, 0.4392880175621413, 0.26728631142900083, 0.2535952510939018, 0.41889314957142915, 0.5559270956451233, 0.45919816850958967, 0.8093771892329064, 0.6269435251529335, 0.7412095630302297, 0.7760585776651067, 0.7140789115602275, 0.14673639545979697, 0.7604862610891273, 0.5716164154938753, 0.5625535192593524, 0.944347962959344, 0.3807182809639865, 0.8117881203166868, 0.3206118581491156, 0.49758625935822787, 0.8828643218104778, 0.9327860776908447, 0.17633159045222863, 0.03163678025755647, 0.929889932044421, 0.753899709950355, 0.9247747536524599, 0.42083071433449426, 0.8917888746160584, 0.25703266421825066, 0.12378932860667925, 0.8303483302571679, 0.5693932033846522, 0.06379229380986756, 0.341844902215873, 0.6260261994244691, 0.6069863408987833, 0.998816875612732, 0.7432885521127224, 0.9630850013551204, 0.6185996779211976, 0.9490039044882588, 0.05715276179914267, 0.19959671456852296, 0.6179940239186649, 0.6483356255135215, 0.9126510638350981, 0.15438502865595324, 0.8870840524329529, 0.36062711482897963, 0.5391091280875356, 0.29795692964915377, 0.4525571383130523, 0.9284651574619829, 0.9555656356664469, 0.16641354472237804, 0.9899422059496273, 0.8071447254840065, 0.7739940003232848, 0.9211642444827466, 0.3570052153334599, 0.9399959413977643, 0.02786511872886976, 0.8847745867512792, 0.9794708866809901, 0.009516748915170145, 0.15283812312080336, 0.8278759637703994, 0.18746012697897352, 0.10085892020889194, 0.1791438903865091, 0.17654220930995165, 0.7981738480256944, 0.533963452913235, 0.9513912168986841, 0.6770406040876065, 0.9712177316457771, 0.8728960985276982, 0.6914498382737752, 0.5239131084040699, 0.5378413435856705, 0.22648821788407741, 0.8061130118642355, 0.3440220588830383, 0.621435538562066, 0.009563937642890444, 0.6159428136695944, 0.12330315527743321, 0.46621749835799076, 0.939473382701246, 0.8713912985457151, 0.04276034036158202, 0.2140915338772398, 0.1825516251695283, 0.7447351151964228, 0.08375743623015605, 0.488123850520835, 0.7708632005684973, 0.9076671381429868, 0.09104333388447745, 0.9823153926533318, 0.0258012814198195, 0.44790193932024963, 0.387704956744248, 0.5648812378996954, 0.6887902384119812, 0.6232238358545094, 0.23158670550866237, 0.48894026378902866, 0.9786110831157576, 0.36208199301959176, 0.5301380297347213, 0.9173476437011594, 0.4246103484286543, 0.00894446219570549, 0.3419422061160896, 0.7306869841411903, 0.5348288130917159, 0.6382508004392391, 0.9457069289256771, 0.9795425534037935, 0.48440773490465183, 0.4167170131787498, 0.046049800724360775, 0.9469082640473974, 0.9435048555663805, 0.18248457453112718, 0.9337822891357132, 0.0029009413417333454, 0.4444039041036633, 0.03518142419633393, 0.7397073009976515, 0.4621165019070819, 0.42687362707544385, 0.5187185042192746, 0.013864816533337432, 0.4944684654393695, 0.43458151285367985, 0.9578595989985499, 0.0422515705959749, 0.22670859508842187, 0.08003393112021163, 0.9682204346772418, 0.7471653412982341, 0.37945143538426507, 0.5362266963356532, 0.09064236133892949, 0.07105746774302218, 0.4359102662437841, 0.442759839603803, 0.7669037203097743, 0.7049245662549567, 0.4903021656867442, 0.558002143332565, 0.10639961177117348, 0.0014741544893219533, 0.16896578141347657, 0.3374914553992418, 0.3602703988216869, 0.09094886394748412, 0.14815838041332924, 0.09820993299449175];

    if (!is_array($arr)) {
        return null;
    }

    $size = count($arr);
    $keys = [];
    $resp = [];

    for ($i = 0; $i < $size; $i++) {
        $resp[] = (null);
        $keys[] = $i;
    }

    for ($i = 0; $i < $size; $i++) {
        $min = 0;
        $max = (count($keys) - 1);
        $r = seedRand($seed[$i], $min, $max);
        $g = $keys[$r];
        array_splice($keys, $r, 1);
        $resp[$g] = $arr[$i];
    }

    return $resp;
}

function imgReverser($binary, $sliceSize = 200)
{
    $image = imagecreatefromstring($binary);
    $width = imagesx($image);
    $height = imagesy($image);

    $decode_image = imagecreatetruecolor($width, $height);

    $totalParts = ceil($width / $sliceSize) * ceil($height / $sliceSize);
    $verticalSlices = ceil($width / $sliceSize);

    $slices = [];
    for ($i = 0; $i < $totalParts; $i++) {
        $row = intval($i / $verticalSlices);
        $col = $i - $row * $verticalSlices;
        $slice = [
            'x' => $col * $sliceSize,
            'y' => $row * $sliceSize,
        ];

        $slice_w = $slice['x'] + $sliceSize <= $width ? 0 : ($slice['x'] + $sliceSize) - $width;

        $slice['width'] = ($sliceSize - $slice_w);
        $slice['height'] = ($sliceSize - ($slice['y'] + $sliceSize <= $height ? 0 : ($slice['y'] + $sliceSize) - $height));

        $w_h = "$slice[width]-$slice[height]";
        if (empty($slices[$w_h])) {
            $slices[$w_h] = [];
        }

        $slices[$w_h][] = ($slice);

    }

    foreach ($slices as $key => $slice) {

        $shuffleIndex = unShuffle(createRange(0, count($slice)));
        $group = getGroup($slice);

        foreach ($slices[$key] as $index => $slice) {
            $sIndex = $shuffleIndex[$index];
            $row = intval($sIndex / $group["cols"]);
            $col = $sIndex - ($row * $group["cols"]);
            $x = $col * $slice['width'];
            $y = $row * $slice['height'];

            imagecopy($decode_image, $image,

                $slice['x'],
                $slice['y'],
                $group['x'] + $x,
                $group['y'] + $y,
                $slice['width'],
                $slice['height'],
            );
        }
    }

    ob_start();

    imagejpeg($decode_image);
    imagedestroy($decode_image);
    imagedestroy($image);

    $image_data = ob_get_contents();

    ob_end_clean();

    return $image_data;
}

header('Content-type: image/jpeg');

$url = $_GET['url'];

echo imgReverser(file_get_contents($url));