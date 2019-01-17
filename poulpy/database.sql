create database poulpy;
use poulpy;
CREATE TABLE users(login VARCHAR(30) not null primary key, password VARCHAR(50));
CREATE TABLE users_wallet(login VARCHAR(30), wallet VARCHAR(50));
CREATE TABLE wallet(number varchar(50) not null primary key, XRP float(8, 4), XMR float(8, 4), ETC float(8, 4), ETH float(8, 4), DASH float(8, 4), BCH float(8, 4), XBT float(8, 4));
CREATE TABLE currencies(symbol varchar(10), name varchar(50), rate float(8,4));
CREATE TABLE ledger(id int not null primary key, wallet_out varchar(50), wallet_in varchar(50), type varchar(30), currency varchar(10), amount float(8, 4));
CREATE TABLE message(emeteur VARCHAR(30), recepteur VARCHAR(30), amount float(8, 4), message MEDIUMTEXT);

INSERT INTO users
	(login, password)
VALUES
	('Pirateirb', '8954c0fad06520bbdaa53439b15898c4'),
	('Egatec', '739c5b5facfa2cb43c225d6ea56fb0e9'),
	('Piquin', '00e9908c999954ed6d46feb6e556e929'),
	('Wynamo', '694bc17077170066f67a20015874d1e2'),
	('Womate', '5870d7b6910b73e83b895fe39c525bde'),
	('Spulad', 'ca94d086525dad6f20857b9b72e7e538'),
	('Chield', '6f1705e193b7f6ebebcf016393364a9d'),
	('Oashis', 'a2a4afc856e8fe912f2d0fbade62e3f2'),
	('Jempl', '38b08a18040f5fbbee3e2dffc0cf4b82'),
	('Slade', '25c06648681ee5d4f1693950118b9d52'),
	('Majou', 'b89336377ee97a45fc93c55b41f539e5'),
	('Orype', 'b0e2c2092bbdf1b59e92badbdf3c55b0'),
	('Aucke', '40a617ee68022c352eed50b0e921563c'),
	('Libroma', 'd0b96ef740b4e154bc4981abb673a817'),
	('Hellmor', '2e0f14796fe87ad9b66353e47e78adf7'),
	('Irester', 'f039c7219b104715b757dff0a3ced16c'),
	('Noberbi', '5ba9e27b170945f09e45ac4dd2e51591'),
	('Mifornic', '17db52c8253e0592c8dfbd2f1f5116fe'),
	('Alice', '7682fe272099ea26efe39c890b33675b'),
	('Bob', '0b14ec1baba4b4c1b06fb06e9c0d77d7'),
	('Multorni', '44cb136f528b79ddda42644498c25afb'),
	('Maticank', '0118ff8da983b2d788fca82594ca8e20'),
	('Bufferrato', 'a8cb87bc6a117f948bf7cfe5fbf02478'),
	('Oasticapur', 'fe92ff5f17a942663a6e7192f783de7c'),
	('Bongel', '85429a000e2f65e0a807271ff2729a6f'),
	('Twanco', '9d02ef73b1407e6a1082849ecf275813'),
	('Mehron', 'a859b65b97ea1d6caa80e7e8238da971'),
	('Sazuri', '9557e5e24b29b4d7c0a0cb25a396bef2'),
	('Hegata', 'c4449de62fbec42f15e755dd56dd5c40'),
	('Nohara', '97a1ff787e7973ed1d2978be966a1057'),
	('Kreufe', 'e3fd5d7ea946b7076050bb65320f1bf4');


INSERT INTO users_wallet
	(login, wallet)
VALUES
	('Pirateirb', '3MqfLxPrTUAHkAt1HZArfcCe8DCLhbRtTZ'),
	('Egatec', '31rrKQZm5FkXPrdJAhidnZKsUN6EAZygeE'),
	('Piquin', '3Ap6SFaUzum7vbJ2LiChEzM7dCjTot75mg'),
	('Wynamo', '3K4ZymN6fJRRvne5RxdyGPUc2hbpmskJ2S'),
	('Womate', '3Dfs9qEYnqC3e469RNWKSN1KfyQpHYErWW'),
	('Spulad', '3N45XV2uvSfguTVhehtkAFjr3vWZVVuVWV'),
	('Chield', '3GpKfm5nTd4Um1afhi9WnWa1hnUPAvbAmN'),
	('Oashis', '3AkpM3Qs7J4jey7NPTsipyogMMkQrGvKFp'),
	('Jempl', '33TGS6AyYTGyEsupYaiXFADagSBt3MoBmP'),
	('Slade', '33TEdjiHnCGQYoixsogHFGanPMobVvwkrd'),
	('Majou', '39ziXjQ6h9FWq9hhczJ29tdxhE5zkqszHm'),
	('Orype', '3QMnaWuYSPQV8xNKavacroWCUdMchQNdg5'),
	('Aucke', '3P4NFJ4o2AjN9JQn4Wr7bKWLERV6R3Q3EA'),
	('Libroma', '3QmdndKseRRs8CtFiMS7EZ7KA4qxWZcdKY'),
	('Hellmor', '3AkcKFDJKmuExCrJBCHzDTiZcdB4hqJtFu'),
	('Irester', '3MsPUNKEVVPZyxJyEJENkkpNyY43BA6dh9'),
	('Noberbi', '3DyFVwbqDw1u3HStVgY1Q27bnDfVDuabvp'),
	('Mifornic', '3Qhskv8CWW4XPkQ7XYPBGmGBzhCUEzmMZ4'),
	('Alice', '3FRQC2osBLNL575LjNwvJcxPpVxLmBpF5j'),
	('Bob', '3MVLdLUTDx6qQHd9wwTnr5it1aoqwzMnjR'),
	('Multorni', '3BT8CM5bqNnPGD5DyzKfzSJJQKk5vsWtkv'),
	('Maticank', '3KD4kveLB6FFcvFV23j6oqMBvyP5smVJh6'),
	('Bufferrato', '34QPydEPVPX2drYhAuaM24BP4FzxAQnTWc'),
	('Oasticapur', '3Pv54YFaWGTagHgL7n196BT89HAeigiq86'),
	('Bongel', '3AQ4WhgtZpp1c1uicSnefWT2ag8UgdiSKz'),
	('Twanco', '3ECrrwprSeb22JM9UR5HLYecFs9ZrBuiBE'),
	('Mehron', '3C83SwmUHJgGsrCTuf1ZhdkE1vz82MmuYZ'),
	('Sazuri', '3HJb7zfLVnR3GofWoNzV19fgn5JW4WaGs5'),
	('Hegata', '3NgZSiY8pbU3ESDpaNTsnyWzvTK2aqAZWU'),
	('Nohara', '3EejrxDHyYP3TjDX6UKm8dg2s3hri8Wh8t'),
	('Kreufe', '3GbVKHQbsbG1uZ8drXQKge1DvcsAuy6RAm');


	
	INSERT INTO wallet
		(number, XRP, XMR, ETH, ETC, DASH, BCH, XBT)
	VALUES
        ('3MqfLxPrTUAHkAt1HZArfcCe8DCLhbRtTZ', 0.00000, 0.00000, 0.00000, 0.00000, 0.00000, 0.00000, 0.00000),
        ('31rrKQZm5FkXPrdJAhidnZKsUN6EAZygeE', 90.7193, 0.60453, 1.80576, 0.00013, 0.84235, 0.74011, 0.00182),
        ('3Ap6SFaUzum7vbJ2LiChEzM7dCjTot75mg', 85.0638, 2.83454, 1.84775, 0.00034, 0.72117, 1.81974, 0.00142),
        ('3K4ZymN6fJRRvne5RxdyGPUc2hbpmskJ2S', 85.1480, 3.60567, 0.66375, 0.00196, 0.67977, 1.55961, 0.00043),
        ('3Dfs9qEYnqC3e469RNWKSN1KfyQpHYErWW', 55.0603, 3.1306, 1.20301, 0.00013, 0.92606, 0.10213, 0.00058),
        ('3N45XV2uvSfguTVhehtkAFjr3vWZVVuVWV', 86.4579, 3.82832, 0.68376, 0.00214, 0.32438, 0.99071, 0.00206),
        ('3GpKfm5nTd4Um1afhi9WnWa1hnUPAvbAmN', 95.1240, 3.41021, 0.22397, 0.0032, 0.65155, 0.04103, 0.00165),
        ('3AkpM3Qs7J4jey7NPTsipyogMMkQrGvKFp', 31.6587, 3.07997, 0.33117, 0.00314, 0.26711, 0.83618, 0.00199),
        ('33TGS6AyYTGyEsupYaiXFADagSBt3MoBmP', 13.8436, 1.48397, 0.7676, 0.00425, 0.51609, 1.82595, 0.00151),
        ('33TEdjiHnCGQYoixsogHFGanPMobVvwkrd', 57.6709, 2.15817, 0.85078, 0.00311, 0.34467, 1.72503, 0.00047),
        ('39ziXjQ6h9FWq9hhczJ29tdxhE5zkqszHm', 20.2930, 4.92991, 0.86418, 0.00453, 0.7862, 1.99764, 0.00230),
        ('3QMnaWuYSPQV8xNKavacroWCUdMchQNdg5', 90.1639, 0.29937, 0.52826, 0.00232, 0.03732, 1.19218, 0.00109),
        ('3P4NFJ4o2AjN9JQn4Wr7bKWLERV6R3Q3EA', 20.6849, 0.7303, 0.15444, 0.00032, 0.23582, 0.95231, 0.00030),
        ('3QmdndKseRRs8CtFiMS7EZ7KA4qxWZcdKY', 13.9959, 2.78113, 1.39686, 0.00099, 0.78254, 0.44314, 0.00195),
        ('3AkcKFDJKmuExCrJBCHzDTiZcdB4hqJtFu', 78.9057, 4.60685, 1.49642, 0.00397, 0.17089, 0.98933, 0.00210),
        ('3MsPUNKEVVPZyxJyEJENkkpNyY43BA6dh9', 14.0821, 4.5495, 1.69744, 0.00434, 0.00875, 0.82850, 0.00029),
        ('3DyFVwbqDw1u3HStVgY1Q27bnDfVDuabvp', 34.0091, 0.51854, 1.81535, 0.00463, 0.45188, 1.24445, 0.00090),
        ('3Qhskv8CWW4XPkQ7XYPBGmGBzhCUEzmMZ4', 98.3899, 4.88143, 1.84164, 0.00132, 0.56427, 0.83774, 0.00216),
        ('3FRQC2osBLNL575LjNwvJcxPpVxLmBpF5j', 93.4866, 4.29377, 1.96135, 0.00473, 0.93409, 0.03728, 0.00000),
        ('3MVLdLUTDx6qQHd9wwTnr5it1aoqwzMnjR', 80.6212, 3.69001, 0.19647, 0.00229, 0.70736, 0.40299, 0.33000),
        ('3BT8CM5bqNnPGD5DyzKfzSJJQKk5vsWtkv', 61.1302, 4.35628, 0.8017, 0.00023, 0.87884, 1.78062, 0.00182),
        ('3KD4kveLB6FFcvFV23j6oqMBvyP5smVJh6', 16.9467, 0.62174, 1.64452, 0.00319, 0.47009, 1.89397, 0.00221),
        ('34QPydEPVPX2drYhAuaM24BP4FzxAQnTWc', 18.5478, 3.89602, 0.9926, 0.00156, 0.55555, 0.66426, 0.00054),
        ('3Pv54YFaWGTagHgL7n196BT89HAeigiq86', 67.5367, 2.58387, 1.31315, 0.00204, 0.80064, 1.84950, 0.00286),
        ('3AQ4WhgtZpp1c1uicSnefWT2ag8UgdiSKz', 56.3701, 2.34812, 1.65735, 0.00221, 0.36595, 1.00578, 0.00288),
        ('3ECrrwprSeb22JM9UR5HLYecFs9ZrBuiBE', 74.9656, 3.0144, 1.15261, 0.00203, 0.97007, 1.27874, 0.00145),
        ('3C83SwmUHJgGsrCTuf1ZhdkE1vz82MmuYZ', 46.6810, 3.80607, 0.54805, 0.00328, 0.3326, 0.85613, 0.00013),
        ('3HJb7zfLVnR3GofWoNzV19fgn5JW4WaGs5', 29.5034, 1.04275, 0.37224, 0.00496, 0.80935, 0.26612, 0.00151),
        ('3NgZSiY8pbU3ESDpaNTsnyWzvTK2aqAZWU', 73.1710, 3.15213, 0.58405, 0.00329, 0.53857, 1.94126, 0.00190),
        ('3EejrxDHyYP3TjDX6UKm8dg2s3hri8Wh8t', 98.2965, 0.11605, 0.04067, 0.00108, 0.62045, 1.29934, 0.00181),
        ('3GbVKHQbsbG1uZ8drXQKge1DvcsAuy6RAm', 95.7580, 1.45665, 0.25959, 0.00286, 0.41369, 0.26040, 0.00287);


	INSERT INTO currencies
		(symbol, name, rate)
	VALUES
		('XRP', 'Ripple', 0.3158),
        ('XMR', 'Monero', 43.98),
        ('ETH', 'Ether', 137.82),
        ('ETC', 'Ehter Classic', 4.476),
        ('DASH', 'Dash', 71.195),
        ('BCH', 'Bitcoin Cash', 141.2),
        ('XBT', 'Bitcoin', 3374.7);


    INSERT INTO ledger
        (id, wallet_out, wallet_in, type, currency, amount)
    VALUES
        (1, '3MVLdLUTDx6qQHd9wwTnr5it1aoqwzMnjR', '3FRQC2osBLNL575LjNwvJcxPpVxLmBpF5j', 'Withdrawal', 'EUR', 299.45),
        (2, 'out', '3K4ZymN6fJRRvne5RxdyGPUc2hbpmskJ2S', 'Deposit', 'XBT', 0.01167),
        (3, '3MVLdLUTDx6qQHd9wwTnr5it1aoqwzMnjR', '33TGS6AyYTGyEsupYaiXFADagSBt3MoBmP', 'Withdrawal', 'XBT', 0.99986),
        (4, '3KD4kveLB6FFcvFV23j6oqMBvyP5smVJh6', '3GbVKHQbsbG1uZ8drXQKge1DvcsAuy6RAm', 'Withdrawal', 'EUR', 64.15),
        (5, '3C83SwmUHJgGsrCTuf1ZhdkE1vz82MmuYZ', '3DyFVwbqDw1u3HStVgY1Q27bnDfVDuabvp', 'Withdrawal', 'EUR', 176.66),
        (6, 'out', '3MVLdLUTDx6qQHd9wwTnr5it1aoqwzMnjR', 'Deposit', 'XBT', 1.17749),
        (7, 'out', '33TEdjiHnCGQYoixsogHFGanPMobVvwkrd', 'Deposit', 'XBT', 0.00213),
        (8, '3QmdndKseRRs8CtFiMS7EZ7KA4qxWZcdKY', '3Ap6SFaUzum7vbJ2LiChEzM7dCjTot75mg', 'Withdrawal', 'EUR', 489.01),
        (9, 'out', '3MsPUNKEVVPZyxJyEJENkkpNyY43BA6dh9', 'Deposit', 'XBT', 0.010514),
        (10, 'out', '3NgZSiY8pbU3ESDpaNTsnyWzvTK2aqAZWU', 'Deposit', 'XBT', 0.009873);