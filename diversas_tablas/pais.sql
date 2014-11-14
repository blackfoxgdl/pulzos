CREATE TABLE `pais` (
  `id` smallint(6) unsigned NOT NULL auto_increment,
  `nombre` varchar(150) NOT NULL default '',
  `x` float(13,10) NOT NULL default '0.0000000000',
  `y` float(13,10) NOT NULL default '0.0000000000',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=461 ;

-- 
-- Volcar la base de datos para la tabla `pais`
-- 

INSERT INTO `pais` VALUES (144, 'Afganist&aacute;n', 33.9391098022, 67.7099533081);
INSERT INTO `pais` VALUES (114, 'Albania', 41.1533317566, 20.1683311462);
INSERT INTO `pais` VALUES (18, 'Alemania', 51.1656913757, 10.4515256882);
INSERT INTO `pais` VALUES (98, 'Algeria', 28.0338859558, 1.6596260071);
INSERT INTO `pais` VALUES (145, 'Andorra', 42.5462455750, 1.6015540361);
INSERT INTO `pais` VALUES (119, 'Angola', -11.2026920319, 17.8738861084);
INSERT INTO `pais` VALUES (4, 'Anguilla', 18.2205543518, -63.0686149597);
INSERT INTO `pais` VALUES (147, 'Antigua y Barbuda', 17.0608158112, -61.7964286804);
INSERT INTO `pais` VALUES (207, 'Antillas Holandesas', 12.2260789871, -69.0600891113);
INSERT INTO `pais` VALUES (91, 'Arabia Saudita', 23.8859424591, 45.0791625977);
INSERT INTO `pais` VALUES (5, 'Argentina', -38.4160957336, -63.6166725159);
INSERT INTO `pais` VALUES (6, 'Armenia', 40.0690994263, 45.0381889343);
INSERT INTO `pais` VALUES (142, 'Aruba', 12.5211095810, -69.9683380127);
INSERT INTO `pais` VALUES (1, 'Australia', -25.2743988037, 133.7751312256);
INSERT INTO `pais` VALUES (2, 'Austria', 47.5162315369, 14.5500717163);
INSERT INTO `pais` VALUES (3, 'Azerbaiy&aacute;n', 40.1431045532, 47.5769271851);
INSERT INTO `pais` VALUES (80, 'Bahamas', 25.0342807770, -77.3962783813);
INSERT INTO `pais` VALUES (127, 'Bahrein', 25.9304141998, 50.6377716064);
INSERT INTO `pais` VALUES (149, 'Bangladesh', 23.6849937439, 90.3563308716);
INSERT INTO `pais` VALUES (128, 'Barbados', 13.1938867569, -59.5431976318);
INSERT INTO `pais` VALUES (9, 'B&eacute;lgica', 50.5038871765, 4.4699358940);
INSERT INTO `pais` VALUES (8, 'Belice', 17.1898765564, -88.4976501465);
INSERT INTO `pais` VALUES (151, 'Ben&iacute;n', 9.3076896667, 2.3158340454);
INSERT INTO `pais` VALUES (10, 'Bermudas', 32.3213844299, -64.7573699951);
INSERT INTO `pais` VALUES (7, 'Bielorrusia', 53.7098083496, 27.9533882141);
INSERT INTO `pais` VALUES (123, 'Bolivia', -16.2901535034, -63.5886535645);
INSERT INTO `pais` VALUES (79, 'Bosnia y Herzegovina', 43.9158859253, 17.6790752411);
INSERT INTO `pais` VALUES (100, 'Botsuana', -22.3284740448, 24.6848659515);
INSERT INTO `pais` VALUES (12, 'Brasil', -14.2350044250, -51.9252815247);
INSERT INTO `pais` VALUES (155, 'Brun&eacute;i', 4.5352768898, 114.7276687622);
INSERT INTO `pais` VALUES (11, 'Bulgaria', 42.7338829041, 25.4858303070);
INSERT INTO `pais` VALUES (156, 'Burkina Faso', 12.2383327484, -1.5615930557);
INSERT INTO `pais` VALUES (157, 'Burundi', -3.3730559349, 29.9188861847);
INSERT INTO `pais` VALUES (152, 'But&aacute;n', 27.5141620636, 90.4336013794);
INSERT INTO `pais` VALUES (159, 'Cabo Verde', 16.0020828247, -24.0131969452);
INSERT INTO `pais` VALUES (158, 'Camboya', 12.5656785965, 104.9909667969);
INSERT INTO `pais` VALUES (31, 'Camer&uacute;n', 7.3697218895, 12.3547220230);
INSERT INTO `pais` VALUES (32, 'Canad&aacute;', 56.1303672791, -106.3467712402);
INSERT INTO `pais` VALUES (130, 'Chad', 15.4541664124, 18.7322063446);
INSERT INTO `pais` VALUES (81, 'Chile', -35.6751480103, -71.5429687500);
INSERT INTO `pais` VALUES (35, 'China', 35.8616600037, 104.1953964233);
INSERT INTO `pais` VALUES (33, 'Chipre', 35.1264114380, 33.4298591614);
INSERT INTO `pais` VALUES (82, 'Colombia', 4.5708680153, -74.2973327637);
INSERT INTO `pais` VALUES (164, 'Comores', -11.8750009537, 43.8722190857);
INSERT INTO `pais` VALUES (112, 'Congo (Brazzaville)', -4.2767000198, 15.2662000656);
INSERT INTO `pais` VALUES (165, 'Congo (Kinshasa)', -4.4916658401, 15.8280019760);
INSERT INTO `pais` VALUES (166, 'Cook, Islas', -21.2367362976, -159.7776641846);
INSERT INTO `pais` VALUES (84, 'Corea del Norte', 40.3398513794, 127.5100936890);
INSERT INTO `pais` VALUES (69, 'Corea del Sur', 35.9077568054, 127.7669219971);
INSERT INTO `pais` VALUES (168, 'Costa de Marfil', 7.5399889946, -5.5470800400);
INSERT INTO `pais` VALUES (36, 'Costa Rica', 9.7489166260, -83.7534255981);
INSERT INTO `pais` VALUES (71, 'Croacia', 44.4662437439, 16.4612483978);
INSERT INTO `pais` VALUES (113, 'Cuba', 21.5217571259, -77.7811660767);
INSERT INTO `pais` VALUES (22, 'Dinamarca', 56.2639198303, 9.5017852783);
INSERT INTO `pais` VALUES (169, 'Djibouti, Yibuti', 11.8251380920, 42.5902748108);
INSERT INTO `pais` VALUES (103, 'Ecuador', -1.8312389851, -78.1834030151);
INSERT INTO `pais` VALUES (23, 'Egipto', 26.8205528259, 30.8024978638);
INSERT INTO `pais` VALUES (51, 'El Salvador', 13.7941846848, -88.8965301514);
INSERT INTO `pais` VALUES (93, 'Emiratos &Aacute;rabes Unidos', 23.4240760803, 53.8478164673);
INSERT INTO `pais` VALUES (173, 'Eritrea', 15.1793842316, 39.7823333740);
INSERT INTO `pais` VALUES (52, 'Eslovaquia', 48.6690254211, 19.6990242004);
INSERT INTO `pais` VALUES (53, 'Eslovenia', 46.1512413025, 14.9954633713);
INSERT INTO `pais` VALUES (28, 'Espa&ntilde;a', 40.4636688232, -3.7492198944);
INSERT INTO `pais` VALUES (55, 'Estados Unidos', 37.0902404785, -95.7128906250);
INSERT INTO `pais` VALUES (68, 'Estonia', 58.5952720642, 25.0136070251);
INSERT INTO `pais` VALUES (121, 'Etiop&iacute;a', 9.1450004578, 40.4896736145);
INSERT INTO `pais` VALUES (175, 'Feroe, Islas', 61.8926353455, -6.9118061066);
INSERT INTO `pais` VALUES (90, 'Filipinas', 12.8797206879, 121.7740173340);
INSERT INTO `pais` VALUES (63, 'Finlandia', 61.9241104126, 25.7481517792);
INSERT INTO `pais` VALUES (176, 'Fiyi', -16.5781936646, 179.4144134521);
INSERT INTO `pais` VALUES (64, 'Francia', 46.2276382446, 2.2137489319);
INSERT INTO `pais` VALUES (180, 'Gab&oacute;n', -0.8036890030, 11.6094436646);
INSERT INTO `pais` VALUES (181, 'Gambia', 13.4431819916, -15.3101387024);
INSERT INTO `pais` VALUES (21, 'Georgia', 32.6782073975, -83.1738662720);
INSERT INTO `pais` VALUES (105, 'Ghana', 7.9465270042, -1.0231939554);
INSERT INTO `pais` VALUES (143, 'Gibraltar', 36.1377410889, -5.3453741074);
INSERT INTO `pais` VALUES (184, 'Granada', 12.2627763748, -61.6041717529);
INSERT INTO `pais` VALUES (20, 'Grecia', 39.0742073059, 21.8243122101);
INSERT INTO `pais` VALUES (94, 'Groenlandia', 71.7069396973, -42.6043014526);
INSERT INTO `pais` VALUES (17, 'Guadalupe', 16.9959716797, -62.0676422119);
INSERT INTO `pais` VALUES (185, 'Guatemala', 15.7834711075, -90.2307586670);
INSERT INTO `pais` VALUES (186, 'Guernsey', 49.4656906128, -2.5852780342);
INSERT INTO `pais` VALUES (187, 'Guinea', 9.9455871582, -9.6966447830);
INSERT INTO `pais` VALUES (172, 'Guinea Ecuatorial', 1.6508009434, 10.2678947449);
INSERT INTO `pais` VALUES (188, 'Guinea-Bissau', 11.8037490845, -15.1804132462);
INSERT INTO `pais` VALUES (189, 'Guyana', 4.8604159355, -58.9301795959);
INSERT INTO `pais` VALUES (16, 'Haiti', 18.9711875916, -72.2852172852);
INSERT INTO `pais` VALUES (137, 'Honduras', 15.1999988556, -86.2419052124);
INSERT INTO `pais` VALUES (73, 'Hong Kong', 22.3964271545, 114.1094970703);
INSERT INTO `pais` VALUES (14, 'Hungr&iacute;a', 47.1624946594, 19.5033035278);
INSERT INTO `pais` VALUES (25, 'India', 20.5936832428, 78.9628829956);
INSERT INTO `pais` VALUES (74, 'Indonesia', -0.7892749906, 113.9213256836);
INSERT INTO `pais` VALUES (140, 'Irak', 33.2231903076, 43.6792907715);
INSERT INTO `pais` VALUES (26, 'Ir&aacute;n', 32.4279098511, 53.6880455017);
INSERT INTO `pais` VALUES (27, 'Irlanda', 53.4129104614, -8.2438898087);
INSERT INTO `pais` VALUES (215, 'Isla Pitcairn', -24.7036151886, -127.4393081665);
INSERT INTO `pais` VALUES (83, 'Islandia', 64.9630508423, -19.0208358765);
INSERT INTO `pais` VALUES (228, 'Islas Salom&oacute;n', -9.6457099915, 160.1561889648);
INSERT INTO `pais` VALUES (58, 'Islas Turcas y Caicos', 21.6940250397, -71.7979278564);
INSERT INTO `pais` VALUES (154, 'Islas Virgenes Brit&aacute;nicas', 18.4206943512, -64.6399688721);
INSERT INTO `pais` VALUES (24, 'Israel', 31.0460510254, 34.8516120911);
INSERT INTO `pais` VALUES (29, 'Italia', 41.8719406128, 12.5673799515);
INSERT INTO `pais` VALUES (132, 'Jamaica', 18.1095809937, -77.2975082397);
INSERT INTO `pais` VALUES (70, 'Jap&oacute;n', 36.2048225403, 138.2529296875);
INSERT INTO `pais` VALUES (193, 'Jersey', 49.2144393921, -2.1312499046);
INSERT INTO `pais` VALUES (75, 'Jordania', 30.5851631165, 36.2384147644);
INSERT INTO `pais` VALUES (30, 'Kazajst&aacute;n', 48.0195732117, 66.9236831665);
INSERT INTO `pais` VALUES (97, 'Kenia', -0.0235590003, 37.9061927795);
INSERT INTO `pais` VALUES (34, 'Kirguist&aacute;n', 41.2043800354, 74.7660980225);
INSERT INTO `pais` VALUES (195, 'Kiribati', -3.3704171181, -168.7340393066);
INSERT INTO `pais` VALUES (37, 'Kuwait', 29.3116607666, 47.4817657471);
INSERT INTO `pais` VALUES (196, 'Laos', 19.8562698364, 102.4954986572);
INSERT INTO `pais` VALUES (197, 'Lesotho', -29.6099872589, 28.2336082458);
INSERT INTO `pais` VALUES (38, 'Letonia', 56.8796348572, 24.6031894684);
INSERT INTO `pais` VALUES (99, 'L&iacute;bano', 33.8547210693, 35.8622856140);
INSERT INTO `pais` VALUES (198, 'Liberia', 6.4280548096, -9.4294986725);
INSERT INTO `pais` VALUES (39, 'Libia', 26.3351001740, 17.2283306122);
INSERT INTO `pais` VALUES (126, 'Liechtenstein', 47.1660003662, 9.5553731918);
INSERT INTO `pais` VALUES (40, 'Lituania', 55.1694374084, 23.8812751770);
INSERT INTO `pais` VALUES (41, 'Luxemburgo', 49.8152732849, 6.1295828819);
INSERT INTO `pais` VALUES (85, 'Macedonia', 41.6086349487, 21.7452754974);
INSERT INTO `pais` VALUES (134, 'Madagascar', -18.7669467926, 46.8691062927);
INSERT INTO `pais` VALUES (76, 'Malasia', 4.2104840279, 101.9757690430);
INSERT INTO `pais` VALUES (125, 'Malawi', -13.2543077469, 34.3015251160);
INSERT INTO `pais` VALUES (200, 'Maldivas', 3.2027781010, 73.2206802368);
INSERT INTO `pais` VALUES (133, 'Mal&iacute;', 17.5706920624, -3.9961659908);
INSERT INTO `pais` VALUES (86, 'Malta', 35.9374961853, 14.3754158020);
INSERT INTO `pais` VALUES (131, 'Man, Isla de', 54.2361068726, -4.5480561256);
INSERT INTO `pais` VALUES (104, 'Marruecos', 31.7917022705, -7.0926198959);
INSERT INTO `pais` VALUES (201, 'Martinica', 14.6415281296, -61.0241737366);
INSERT INTO `pais` VALUES (202, 'Mauricio', -20.3484039307, 57.5521507263);
INSERT INTO `pais` VALUES (108, 'Mauritania', 21.0078907013, -10.9408349991);
INSERT INTO `pais` VALUES (42, 'M&eacute;xico', 23.6345005035, -102.5527877808);
INSERT INTO `pais` VALUES (43, 'Moldavia', 47.4116325378, 28.3698844910);
INSERT INTO `pais` VALUES (44, 'M&oacute;naco', 43.7502975464, 7.4128408432);
INSERT INTO `pais` VALUES (139, 'Mongolia', 46.8624954224, 103.8466567993);
INSERT INTO `pais` VALUES (117, 'Mozambique', -18.6656951904, 35.5295639038);
INSERT INTO `pais` VALUES (205, 'Myanmar', 21.9139652252, 95.9562225342);
INSERT INTO `pais` VALUES (102, 'Namibia', -22.9576396942, 18.4904098511);
INSERT INTO `pais` VALUES (206, 'Nauru', -0.5227779746, 166.9315032959);
INSERT INTO `pais` VALUES (107, 'Nepal', 28.3948574066, 84.1240081787);
INSERT INTO `pais` VALUES (209, 'Nicaragua', 12.8654155731, -85.2072296143);
INSERT INTO `pais` VALUES (210, 'N&iacute;ger', 17.6077880859, 8.0816659927);
INSERT INTO `pais` VALUES (115, 'Nigeria', 9.0819988251, 8.6752767563);
INSERT INTO `pais` VALUES (212, 'Norfolk Island', -29.0408344269, 167.9547119141);
INSERT INTO `pais` VALUES (46, 'Noruega', 60.4720230103, 8.4689464569);
INSERT INTO `pais` VALUES (208, 'Nueva Caledonia', -20.9043045044, 165.6180419922);
INSERT INTO `pais` VALUES (45, 'Nueva Zelanda', -40.9005584717, 174.8859710693);
INSERT INTO `pais` VALUES (213, 'Om&aacute;n', 21.5125827789, 55.9232559204);
INSERT INTO `pais` VALUES (19, 'Pa&iacute;ses Bajos, Holanda', 52.1326332092, 5.2912659645);
INSERT INTO `pais` VALUES (87, 'Pakist&aacute;n', 30.3753204346, 69.3451156616);
INSERT INTO `pais` VALUES (124, 'Panam&aacute;', 8.5379810333, -80.7821273804);
INSERT INTO `pais` VALUES (88, 'Pap&uacute;a-Nueva Guinea', -6.3149929047, 143.9555511475);
INSERT INTO `pais` VALUES (110, 'Paraguay', -23.4425029755, -58.4438323975);
INSERT INTO `pais` VALUES (89, 'Per&uacute;', -9.1899671555, -75.0151519775);
INSERT INTO `pais` VALUES (178, 'Polinesia Francesa', -17.6797428131, -149.4068450928);
INSERT INTO `pais` VALUES (47, 'Polonia', 51.9194374084, 19.1451358795);
INSERT INTO `pais` VALUES (48, 'Portugal', 39.3998718262, -8.2244539261);
INSERT INTO `pais` VALUES (246, 'Puerto Rico', 18.2208328247, -66.5901489258);
INSERT INTO `pais` VALUES (216, 'Qatar', 25.3548259735, 51.1838836670);
INSERT INTO `pais` VALUES (13, 'Reino Unido', 55.3780517578, -3.4359729290);
INSERT INTO `pais` VALUES (65, 'Rep&uacute;blica Checa', 49.8174934387, 15.4729623795);
INSERT INTO `pais` VALUES (138, 'Rep&uacute;blica Dominicana', 18.7356929779, -70.1626510620);
INSERT INTO `pais` VALUES (49, 'Reuni&oacute;n', -21.1151409149, 55.5363845825);
INSERT INTO `pais` VALUES (217, 'Ruanda', -1.9402780533, 29.8738880157);
INSERT INTO `pais` VALUES (72, 'Ruman&iacute;a', 45.9431610107, 24.9667606354);
INSERT INTO `pais` VALUES (50, 'Rusia', 61.5240097046, 105.3187561035);
INSERT INTO `pais` VALUES (242, 'S&aacute;hara Occidental', 24.2155265808, -12.8858337402);
INSERT INTO `pais` VALUES (223, 'Samoa', -13.7590293884, -172.1046295166);
INSERT INTO `pais` VALUES (219, 'San Cristobal y Nevis', 17.3578224182, -62.7829971313);
INSERT INTO `pais` VALUES (224, 'San Marino', 43.9423599243, 12.4577770233);
INSERT INTO `pais` VALUES (221, 'San Pedro y Miquel&oacute;n', 46.9419364929, -56.2711105347);
INSERT INTO `pais` VALUES (225, 'San Tom&eacute; y Pr&iacute;ncipe', 0.1863600016, 6.6130809784);
INSERT INTO `pais` VALUES (222, 'San Vincente y Granadinas', 12.9843053818, -61.2872276306);
INSERT INTO `pais` VALUES (218, 'Santa Elena', -24.1434745789, -10.0306959152);
INSERT INTO `pais` VALUES (220, 'Santa Luc&iacute;a', 13.9094438553, -60.9788932800);
INSERT INTO `pais` VALUES (135, 'Senegal', 14.4974012375, -14.4523620605);
INSERT INTO `pais` VALUES (226, 'Serbia y Montenegro', 43.6679191589, 21.0566902161);
INSERT INTO `pais` VALUES (109, 'Seychelles', -4.6795740128, 55.4919776917);
INSERT INTO `pais` VALUES (227, 'Sierra Leona', 8.4605550766, -11.7798891068);
INSERT INTO `pais` VALUES (77, 'Singapur', 1.3520829678, 103.8198394775);
INSERT INTO `pais` VALUES (106, 'Siria', 34.8020744324, 38.9968147278);
INSERT INTO `pais` VALUES (229, 'Somalia', 5.1521492004, 46.1996154785);
INSERT INTO `pais` VALUES (120, 'Sri Lanka', 7.8730540276, 80.7717971802);
INSERT INTO `pais` VALUES (141, 'Sud&aacute;frica', -30.5594825745, 22.9375057220);
INSERT INTO `pais` VALUES (232, 'Sud&aacute;n', 12.8628072739, 30.2176361084);
INSERT INTO `pais` VALUES (67, 'Suecia', 60.1281623840, 18.6435012817);
INSERT INTO `pais` VALUES (66, 'Suiza', 46.8181877136, 8.2275123596);
INSERT INTO `pais` VALUES (54, 'Surinam', 3.9193050861, -56.0277824402);
INSERT INTO `pais` VALUES (234, 'Swazilandia', -26.5225028992, 31.4658660889);
INSERT INTO `pais` VALUES (56, 'Tadjikistan', 38.8610343933, 71.2760925293);
INSERT INTO `pais` VALUES (92, 'Tailandia', 15.8700323105, 100.9925384521);
INSERT INTO `pais` VALUES (78, 'Taiwan', 23.6978092194, 120.9605178833);
INSERT INTO `pais` VALUES (101, 'Tanzania', -6.3690280914, 34.8888206482);
INSERT INTO `pais` VALUES (171, 'Timor Oriental', -8.8742170334, 125.7275390625);
INSERT INTO `pais` VALUES (136, 'Togo', 8.6195430756, 0.8247820139);
INSERT INTO `pais` VALUES (235, 'Tokelau', -8.9673633575, -171.8558807373);
INSERT INTO `pais` VALUES (236, 'Tonga', -21.1789855957, -175.1982421875);
INSERT INTO `pais` VALUES (237, 'Trinidad y Tobago', 10.6918029785, -61.2225036621);
INSERT INTO `pais` VALUES (122, 'T&uacute;nez', 33.8869171143, 9.5374994278);
INSERT INTO `pais` VALUES (57, 'Turkmenistan', 38.9697189331, 59.5562782288);
INSERT INTO `pais` VALUES (59, 'Turqu&iacute;a', 38.9637451172, 35.2433204651);
INSERT INTO `pais` VALUES (239, 'Tuvalu', -7.1095352173, 177.6493225098);
INSERT INTO `pais` VALUES (62, 'Ucrania', 48.3794326782, 31.1655807495);
INSERT INTO `pais` VALUES (60, 'Uganda', 1.3733329773, 32.2902755737);
INSERT INTO `pais` VALUES (111, 'Uruguay', -32.5227775574, -55.7658348083);
INSERT INTO `pais` VALUES (61, 'Uzbekist&aacute;n', 41.3774909973, 64.5852584839);
INSERT INTO `pais` VALUES (240, 'Vanuatu', -15.3767061234, 166.9591522217);
INSERT INTO `pais` VALUES (95, 'Venezuela', 6.4237499237, -66.5897293091);
INSERT INTO `pais` VALUES (15, 'Vietnam', 14.0583238602, 108.2771987915);
INSERT INTO `pais` VALUES (241, 'Wallis y Futuna', -13.7687520981, -177.1560974121);
INSERT INTO `pais` VALUES (243, 'Yemen', 15.5527267456, 48.5163879395);
INSERT INTO `pais` VALUES (116, 'Zambia', -13.1338968277, 27.8493328094);
INSERT INTO `pais` VALUES (96, 'Zimbabwe', -19.0154380798, 29.1548576355);