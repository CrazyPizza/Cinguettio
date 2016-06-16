--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: apprezzamento; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE apprezzamento (
    descrizione character varying(50) NOT NULL,
    data date NOT NULL,
    ora time with time zone NOT NULL,
    id_immagine numeric,
    creatore_immagine character varying,
    apprezzante character varying
);


ALTER TABLE apprezzamento OWNER TO postgres;

--
-- Name: cinguettio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cinguettio (
    id_cinguettio numeric NOT NULL,
    mail character varying NOT NULL,
    data_e_ora timestamp with time zone NOT NULL,
    testo character varying(100) NOT NULL
);


ALTER TABLE cinguettio OWNER TO postgres;

--
-- Name: esperto; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE esperto (
    mail character varying NOT NULL,
    data date NOT NULL
);


ALTER TABLE esperto OWNER TO postgres;

--
-- Name: immagine; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE immagine (
    id_immagine numeric NOT NULL,
    mail character varying NOT NULL,
    data_e_ora timestamp with time zone NOT NULL,
    url character varying NOT NULL,
    descrizione character varying(20)
);


ALTER TABLE immagine OWNER TO postgres;

--
-- Name: luogo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE luogo (
    id_luogo numeric NOT NULL,
    mail character varying NOT NULL,
    data_e_ora timestamp with time zone NOT NULL,
    latitudine numeric(8,6) NOT NULL,
    longitudine numeric(9,6) NOT NULL
);


ALTER TABLE luogo OWNER TO postgres;

--
-- Name: segnalato; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE segnalato (
    id_cinguettio numeric NOT NULL,
    mail character varying NOT NULL,
    segnalante character varying NOT NULL,
    CONSTRAINT not_self CHECK (((mail)::text <> (segnalante)::text))
);


ALTER TABLE segnalato OWNER TO postgres;

--
-- Name: segue; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE segue (
    segue character varying NOT NULL,
    seguito character varying NOT NULL,
    CONSTRAINT not_self CHECK (((segue)::text <> (seguito)::text))
);


ALTER TABLE segue OWNER TO postgres;

--
-- Name: utente; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE utente (
    mail character varying NOT NULL,
    password character varying NOT NULL,
    nome character varying NOT NULL,
    cognome character varying NOT NULL,
    data_nascita date,
    luogo_nascita character varying,
    citta_residenza character varying,
    id_luogo numeric,
    creatore_luogo character varying,
    nazionalita character varying,
    sesso numeric(1,0) DEFAULT 1 NOT NULL,
    logged numeric(1,0) DEFAULT 0 NOT NULL,
    CONSTRAINT is_a_mail CHECK (((mail)::text ~~ '_%@_%._%'::text)),
    CONSTRAINT log_numeric CHECK (((logged = (1)::numeric) OR (logged = (0)::numeric))),
    CONSTRAINT sex_number CHECK (((sesso = (1)::numeric) OR (sesso = (0)::numeric)))
);


ALTER TABLE utente OWNER TO postgres;

--
-- Data for Name: apprezzamento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY apprezzamento (descrizione, data, ora, id_immagine, creatore_immagine, apprezzante) FROM stdin;
WOAH	2016-06-10	16:47:54.57899+02	10001	bisboccia90@gmail.com	giapponeole@gmail.com
Bello!!!	2016-06-15	15:57:53.474886+02	10002	googlefan@gmail.com	giapponeole@gmail.com
\.


--
-- Data for Name: cinguettio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cinguettio (id_cinguettio, mail, data_e_ora, testo) FROM stdin;
10000	steve@outlook.com	2016-05-26 13:37:00+02	Concerto a Quarto Oggiaro alle 17.00
10000	sempremorto@hotmail.it	2015-05-18 10:11:05.386907+02	Anata wa Furīza to tatakau tame ni ikimasu! Brrrrr....
10000	googlefan@gmail.com	2016-05-18 10:15:19.013571+02	Viva Android! Ios lagga!!!
10000	bisboccia90@gmail.com	2016-04-23 10:15:57.413235+02	La parte migliore della festa è il cocktail di gamberetti ;)
10000	richard@gmail.com	2016-05-18 00:17:28.292267+02	Anche stasera SuShi!!!
10001	sempremorto@hotmail.it	2016-05-25 19:12:31.236056+02	Ōbu o mitsukeru to watashi o sosei
10000	giapponeole@gmail.com	2016-05-25 19:14:39.500196+02	Gotta checciemmoll
10001	giapponeole@gmail.com	2016-05-25 19:17:31.374849+02	Viva i pokemooooon
10002	giapponeole@gmail.com	2016-05-25 19:18:05.343249+02	Sono depressa
10003	giapponeole@gmail.com	2016-06-07 17:54:23.588516+02	Vitto Suca!
10000	captainrussia@hotmail.com	2016-06-15 03:19:45.220685+02	Gliela stiamo facendo vedere in Francia cazzo!!!!
10000	polli.love@gmail.com	2016-06-16 22:14:15.579765+02	Amo i miei polli
\.


--
-- Data for Name: esperto; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY esperto (mail, data) FROM stdin;
googlefan@gmail.com	2016-06-09
badass99@gmail.com	2016-06-09
giapponeole@gmail.com	2016-06-10
worder_s@outlook.com	2016-06-16
\.


--
-- Data for Name: immagine; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY immagine (id_immagine, mail, data_e_ora, url, descrizione) FROM stdin;
10000	worder_s@outlook.com	2015-05-18 09:54:04.342953+02	http://orig04.deviantart.net/95cb/f/2015/027/8/f/_murica_cant_hear_you_over_their_freedom__by_destinysreward-d8flm4d.jpg	MURICA!
10001	bisboccia90@gmail.com	2016-05-18 09:54:50.023103+02	http://valleysleepcenter.com/blog/wp-content/uploads/2013/08/bigstock-Man-comfortably-sleeping-in-hi-15694625.jpg	Io adesso...zzz
10001	marcolino@outlook.com	2016-05-18 09:56:18.215865+02	http://sognienumeri.it/wp-content/uploads/2015/10/sognare-esplosione.jpg	BAAAANG!!!!
10005	sempremorto@hotmail.it	2016-01-18 09:52:48.860451+01	http://www.dbfamily.altervista.org/immaginidbz/Crilin2/Crilin_02.jpg	Kyūjitsu
10004	sempremorto@hotmail.it	2016-05-17 23:51:59.804893+02	http://vignette2.wikia.nocookie.net/dragonball/images/2/26/Render_crilin_prima_serie_by_poh2000-d4n0b9t.png/revision/latest?cb=20141121202831&path-prefix=it	Kodomo no koro
10002	googlefan@gmail.com	2016-05-25 19:12:56.054381+02	http://it.ubergizmo.com/wp-content/uploads/2013/06/android-vs-apple.jpg	Apple sucks
10001	googlefan@gmail.com	2015-08-05 07:47:38.438481+02	https://pbs.twimg.com/profile_images/616076655547682816/6gMRtQyY.jpg	UHUUUUUU ANDROID!
10003	richard@gmail.com	2016-05-18 09:42:00.461877+02	http://i2.wp.com/www.viaggi-lowcost.info/wp-content/uploads/2014/08/Hofbr%C3%83%C2%A4uhaus-monaco.jpg?resize=658%2C340	Birreria di Hitler
10004	richard@gmail.com	2016-05-25 19:13:03.18013+02	https://upload.wikimedia.org/wikipedia/commons/9/93/Golfo_di_Sal%C3%B2.JPG	Salò e il suo lago
10006	sempremorto@hotmail.it	2016-05-18 09:50:11.195522+02	http://vignette1.wikia.nocookie.net/nonciclopedia/images/1/10/Crilin2.jpg/revision/latest?cb=20090831223757	Watashi wa
10004	badass99@gmail.com	2016-04-23 09:46:23.892891+02	https://openclipart.org/download/225309/Russia.svg	MotherFucker RUSSIA
10002	marcolino@outlook.com	2016-04-18 09:55:52.840644+02	http://www.focus.it/site_stored/imgs/0003/007/aperturabomba.630x360.jpg	BOOOM!!!!!
10004	giapponeole@gmail.com	2016-06-07 20:34:54.076208+02	http://a.mytrend.it/fxe/2016/05/635543/o.355773.jpg	Bella...
10001	captainrussia@hotmail.com	2016-06-15 03:28:20.419666+02	https://www.danmurphys.com.au/media/DM/Product/308x385/902023_0_9999_med_v1_m56577569854526968.png	Yummmmm
\.


--
-- Data for Name: luogo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY luogo (id_luogo, mail, data_e_ora, latitudine, longitudine) FROM stdin;
10001	richard@gmail.com	2016-05-18 09:31:40.147266+02	45.599655	10.519028
10000	badass99@gmail.com	2016-05-18 00:02:26.388038+02	-23.345641	-123.123456
10002	badass99@gmail.com	2016-04-18 10:04:06.880708+02	45.000000	180.000000
10001	badass99@gmail.com	2016-05-25 19:13:21.878845+02	34.445768	-12.334567
10003	badass99@gmail.com	2016-05-25 19:13:27.785652+02	19.223233	-164.333445
10000	marcolino@outlook.com	2016-05-25 19:13:37.493147+02	12.444550	1.000000
10002	richard@gmail.com	2016-05-18 09:28:47.643089+02	48.137795	11.580229
10003	sempremorto@hotmail.it	2016-05-18 10:25:38.286404+02	23.000000	-142.445643
10005	giapponeole@gmail.com	2016-06-07 21:05:21.521756+02	45.356777	10.558594
1	captainrussia@hotmail.com	2016-06-10 17:08:34.348627+02	60.514926	32.599365
\.


--
-- Data for Name: segnalato; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY segnalato (id_cinguettio, mail, segnalante) FROM stdin;
10000	googlefan@gmail.com	badass99@gmail.com
10002	giapponeole@gmail.com	captainrussia@hotmail.com
10001	sempremorto@hotmail.it	giapponeole@gmail.com
\.


--
-- Data for Name: segue; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY segue (segue, seguito) FROM stdin;
bisboccia90@gmail.com	worder_s@outlook.com
captainrussia@hotmail.com	badass99@gmail.com
captainrussia@hotmail.com	steve@outlook.com
marcolino@outlook.com	googlefan@gmail.com
giapponeole@gmail.com	googlefan@gmail.com
captainrussia@hotmail.com	googlefan@gmail.com
marcolino@outlook.com	badass99@gmail.com
bisboccia90@gmail.com	giapponeole@gmail.com
giapponeole@gmail.com	sempremorto@hotmail.it
captainrussia@hotmail.com	giapponeole@gmail.com
giapponeole@gmail.com	badass99@gmail.com
googlefan@gmail.com	giapponeole@gmail.com
googlefan@gmail.com	worder_s@outlook.com
polli.love@gmail.com	marcolino@outlook.com
polli.love@gmail.com	worder_s@outlook.com
\.


--
-- Data for Name: utente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY utente (mail, password, nome, cognome, data_nascita, luogo_nascita, citta_residenza, id_luogo, creatore_luogo, nazionalita, sesso, logged) FROM stdin;
bisboccia90@gmail.com	festa	Marco	Marcondino	1990-05-26	Lodi	Lodi	\N	\N	Italia	1	0
marcolino@outlook.com	arduinoLove	Marcolino	Coppolati	1987-01-13	Canusa	Canusa	\N	\N	Italia	1	0
badass99@gmail.com	russia_power	Vladimir	Putin	1960-07-10	Moscow	Moscow	\N	\N	Russia	1	0
richard@gmail.com	gatto123	Richard David	Greco	1990-12-28	Lodi	Lodi	\N	\N	Italia	1	0
steve@outlook.com	occhiali_da_sole	Stevie	Wonder	1960-04-05	New York	Washington	\N	\N	USA	1	0
googlefan@gmail.com	AndroidBestOs	Giulia	Rossi	1999-04-30	Pavia	Pavia	\N	\N	Italia	0	0
worder_s@outlook.com	muricaSwag	Wonder	Woman	1987-06-13	Boston	New York	\N	\N	USA	0	0
polli.love@gmail.com	pollame	Antonio	Amadori	\N			\N	\N		1	0
giapponeole@gmail.com	hosomaki	Erminia	Lopinto	\N	Milano	Milano	10003	badass99@gmail.com	Italia	0	0
sempremorto@hotmail.it	portafogli	Crilin	Alberti	1981-09-03	Tokyo	Milano	\N	\N	Giappone	1	0
captainrussia@hotmail.com	vodkaPutin9	Dimitri	Sokov	1980-08-15	Moscow	San PietroStalin	10000	badass99@gmail.com	Russia	1	1
\.


--
-- Name: apprezzamento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY apprezzamento
    ADD CONSTRAINT apprezzamento_pkey PRIMARY KEY (descrizione, data, ora);


--
-- Name: cinguettio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cinguettio
    ADD CONSTRAINT cinguettio_pkey PRIMARY KEY (id_cinguettio, mail);


--
-- Name: esperto_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY esperto
    ADD CONSTRAINT esperto_pkey PRIMARY KEY (mail);


--
-- Name: immagine_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY immagine
    ADD CONSTRAINT immagine_pkey PRIMARY KEY (id_immagine, mail);


--
-- Name: luogo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY luogo
    ADD CONSTRAINT luogo_pkey PRIMARY KEY (id_luogo, mail);


--
-- Name: segnalati_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY segnalato
    ADD CONSTRAINT segnalati_pkey PRIMARY KEY (id_cinguettio, mail, segnalante);


--
-- Name: segue_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY segue
    ADD CONSTRAINT segue_pkey PRIMARY KEY (segue, seguito);


--
-- Name: utente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY utente
    ADD CONSTRAINT utente_pkey PRIMARY KEY (mail);


--
-- Name: apprezzamento_apprezzante_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY apprezzamento
    ADD CONSTRAINT apprezzamento_apprezzante_fkey FOREIGN KEY (apprezzante) REFERENCES esperto(mail) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: apprezzamento_id_immagine_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY apprezzamento
    ADD CONSTRAINT apprezzamento_id_immagine_fkey FOREIGN KEY (id_immagine, creatore_immagine) REFERENCES immagine(id_immagine, mail) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cinguettio_mail_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cinguettio
    ADD CONSTRAINT cinguettio_mail_fkey FOREIGN KEY (mail) REFERENCES utente(mail) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: esperti_mail_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY esperto
    ADD CONSTRAINT esperti_mail_fkey FOREIGN KEY (mail) REFERENCES utente(mail) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: immagine_mail_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY immagine
    ADD CONSTRAINT immagine_mail_fkey FOREIGN KEY (mail) REFERENCES utente(mail) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: luogo_creatore_luogo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY luogo
    ADD CONSTRAINT luogo_creatore_luogo_fkey FOREIGN KEY (mail) REFERENCES utente(mail) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: segnalati_id_cinguettio_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY segnalato
    ADD CONSTRAINT segnalati_id_cinguettio_fkey FOREIGN KEY (id_cinguettio, mail) REFERENCES cinguettio(id_cinguettio, mail) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: segnalati_segnalante_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY segnalato
    ADD CONSTRAINT segnalati_segnalante_fkey FOREIGN KEY (segnalante) REFERENCES utente(mail) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: segue_mail_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY segue
    ADD CONSTRAINT segue_mail_fkey FOREIGN KEY (segue) REFERENCES utente(mail) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: segue_seguito_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY segue
    ADD CONSTRAINT segue_seguito_fkey FOREIGN KEY (seguito) REFERENCES utente(mail) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: utente_id_luogo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY utente
    ADD CONSTRAINT utente_id_luogo_fkey FOREIGN KEY (id_luogo, creatore_luogo) REFERENCES luogo(id_luogo, mail) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

