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
    seguito character varying NOT NULL
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
    "città_residenza" character varying,
    sesso boolean DEFAULT true NOT NULL,
    logged boolean DEFAULT false NOT NULL,
    id_luogo numeric,
    creatore_luogo character varying,
    "nazionalità" character varying
);


ALTER TABLE utente OWNER TO postgres;

--
-- Data for Name: apprezzamento; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO apprezzamento VALUES ('Bellaaaaa', '2016-05-25', '19:30:26.754389+02', 10000, 'googlefan@gmail.com', 'giapponeole@gmail.com');
INSERT INTO apprezzamento VALUES ('Me pias no trop', '2016-05-25', '19:30:38.586891+02', 10000, 'marcolino@outlook.com', 'giapponeole@gmail.com');


--
-- Data for Name: cinguettio; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO cinguettio VALUES (10000, 'steve@outlook.com', '2016-05-26 13:37:00+02', 'Concerto a Quarto Oggiaro alle 17.00');
INSERT INTO cinguettio VALUES (10000, 'sempremorto@hotmail.it', '2015-05-18 10:11:05.386907+02', 'Anata wa Furīza to tatakau tame ni ikimasu! Brrrrr....');
INSERT INTO cinguettio VALUES (10000, 'googlefan@gmail.com', '2016-05-18 10:15:19.013571+02', 'Viva Android! Ios lagga!!!');
INSERT INTO cinguettio VALUES (10000, 'bisboccia90@gmail.com', '2016-04-23 10:15:57.413235+02', 'La parte migliore della festa è il cocktail di gamberetti ;)');
INSERT INTO cinguettio VALUES (10000, 'richard@gmail.com', '2016-05-18 00:17:28.292267+02', 'Anche stasera SuShi!!!');
INSERT INTO cinguettio VALUES (10001, 'sempremorto@hotmail.it', '2016-05-25 19:12:31.236056+02', 'Ōbu o mitsukeru to watashi o sosei');
INSERT INTO cinguettio VALUES (10000, 'giapponeole@gmail.com', '2016-05-25 19:14:39.500196+02', 'Gotta checciemmoll');
INSERT INTO cinguettio VALUES (10001, 'giapponeole@gmail.com', '2016-05-25 19:17:31.374849+02', 'Viva i pokemooooon');
INSERT INTO cinguettio VALUES (10002, 'giapponeole@gmail.com', '2016-05-25 19:18:05.343249+02', 'Sono depressa');


--
-- Data for Name: esperto; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO esperto VALUES ('giapponeole@gmail.com', '2016-05-25');


--
-- Data for Name: immagine; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO immagine VALUES (10000, 'richard@gmail.com', '2016-05-18 09:42:00.461877+02', 'https://www.google.it/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&cad=rja&uact=8&ved=0ahUKEwjZt-jkj-PMAhUDtxQKHaxpAm4QjBwIBA&url=http%3A%2F%2Fi2.wp.com%2Fwww.viaggi-lowcost.info%2Fwp-content%2Fuploads%2F2014%2F08%2FHofbr%25C3%2583%25C2%25A4uhaus-monaco.jpg%3Fresize%3D658%252C340&psig=AFQjCNE1fK71VQDjpXYQE9ddJeGFAUtL9A&ust=1463643676411532', 'Birreria di Hitler');
INSERT INTO immagine VALUES (10000, 'badass99@gmail.com', '2016-04-23 09:46:23.892891+02', 'https://www.google.it/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&cad=rja&uact=8&ved=0ahUKEwiB2pCjkOPMAhVCXhoKHdrpASIQjBwIBA&url=https%3A%2F%2Fopenclipart.org%2Fdownload%2F225309%2FRussia.svg&psig=AFQjCNFQu7YDR746syhwexFtG4vIpu6mpQ&ust=1463643818826762', 'MotherFucker RUSSIA');
INSERT INTO immagine VALUES (10000, 'googlefan@gmail.com', '2015-08-05 07:47:38.438481+02', 'https://www.google.it/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&cad=rja&uact=8&ved=0ahUKEwjqn6eDkePMAhWGBBoKHWxkBE0QjBwIBA&url=https%3A%2F%2Fpbs.twimg.com%2Fprofile_images%2F616076655547682816%2F6gMRtQyY.jpg&bvm=bv.122129774,d.d2s&psig=AFQjCNGzQsd4z3T3_GY4TK73Uz3ci7gF-w&ust=1463644018490343', 'UHUUUUUU ANDROID!');
INSERT INTO immagine VALUES (10000, 'sempremorto@hotmail.it', '2016-05-18 09:50:11.195522+02', 'https://www.google.it/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&cad=rja&uact=8&ved=0ahUKEwj45pXOkePMAhVDXBoKHfoNBR0QjBwIBA&url=http%3A%2F%2Fvignette1.wikia.nocookie.net%2Fnonciclopedia%2Fimages%2F1%2F10%2FCrilin2.jpg%2Frevision%2Flatest%3Fcb%3D20090831223757&bvm=bv.122129774,d.d2s&psig=AFQjCNHGPubYO7Hv0WrI0GDuBuMszFaH9g&ust=1463644179084779', 'Watashi wa');
INSERT INTO immagine VALUES (10001, 'sempremorto@hotmail.it', '2016-05-17 23:51:59.804893+02', 'https://www.google.it/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&cad=rja&uact=8&ved=0ahUKEwjw4K7lkePMAhULWBoKHRPCCfAQjBwIBA&url=http%3A%2F%2Fvignette2.wikia.nocookie.net%2Fdragonball%2Fimages%2F2%2F26%2FRender_crilin_prima_serie_by_poh2000-d4n0b9t.png%2Frevision%2Flatest%3Fcb%3D20141121202831%26path-prefix%3Dit&bvm=bv.122129774,d.d2s&psig=AFQjCNHGPubYO7Hv0WrI0GDuBuMszFaH9g&ust=1463644179084779', 'Kodomo no koro');
INSERT INTO immagine VALUES (10002, 'sempremorto@hotmail.it', '2016-01-18 09:52:48.860451+01', 'https://www.google.it/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&cad=rja&uact=8&ved=0ahUKEwj55qSdkuPMAhXFrRoKHSeqAs0QjBwIBA&url=http%3A%2F%2Fwww.dbfamily.altervista.org%2Fimmaginidbz%2FCrilin2%2FCrilin_02.jpg&bvm=bv.122129774,d.d2s&psig=AFQjCNHGPubYO7Hv0WrI0GDuBuMszFaH9g&ust=1463644179084779', 'Kyūjitsu');
INSERT INTO immagine VALUES (10000, 'worder_s@outlook.com', '2015-05-18 09:54:04.342953+02', 'https://www.google.it/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&cad=rja&uact=8&ved=0ahUKEwi-jLPEkuPMAhWDWBoKHQ3tCewQjBwIBA&url=http%3A%2F%2Forig04.deviantart.net%2F95cb%2Ff%2F2015%2F027%2F8%2Ff%2F_murica_cant_hear_you_over_their_freedom__by_destinysreward-d8flm4d.jpg&bvm=bv.122129774,d.d2s&psig=AFQjCNFNVDXNF5ITnnNlz1VN_Eijsd0qZA&ust=1463644423864032', 'MURICA!');
INSERT INTO immagine VALUES (10001, 'bisboccia90@gmail.com', '2016-05-18 09:54:50.023103+02', 'https://www.google.it/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&cad=rja&uact=8&ved=0ahUKEwiV9vHZkuPMAhUEChoKHRwRDzcQjBwIBA&url=http%3A%2F%2Fvalleysleepcenter.com%2Fblog%2Fwp-content%2Fuploads%2F2013%2F08%2Fbigstock-Man-comfortably-sleeping-in-hi-15694625.jpg&bvm=bv.122129774,d.d2s&psig=AFQjCNGMuqgtJJByEsFYzOIhAVI8DxnG3g&ust=1463644471570910', 'Io adesso...zzz');
INSERT INTO immagine VALUES (10000, 'marcolino@outlook.com', '2016-04-18 09:55:52.840644+02', 'https://www.google.it/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&cad=rja&uact=8&ved=0ahUKEwi0kYD4kuPMAhVIExoKHYPsBRQQjBwIBA&url=http%3A%2F%2Fimmagini.4ever.eu%2Fdata%2Fdownload%2Faltro%2Fesplosione-nucleare-128018.jpg&bvm=bv.122129774,d.d2s&psig=AFQjCNHpWd_Bcr6L1hWHy_u2gd3fgzWyVQ&ust=1463644534754149', 'BOOOM!!!!!');
INSERT INTO immagine VALUES (10001, 'marcolino@outlook.com', '2016-05-18 09:56:18.215865+02', 'https://www.google.it/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&cad=rja&uact=8&ved=0ahUKEwiezqiEk-PMAhUHWRoKHeAVBqYQjBwIBA&url=http%3A%2F%2Fsognienumeri.it%2Fwp-content%2Fuploads%2F2015%2F10%2Fsognare-esplosione.jpg&bvm=bv.122129774,d.d2s&psig=AFQjCNHpWd_Bcr6L1hWHy_u2gd3fgzWyVQ&ust=1463644534754149', 'BAAAANG!!!!');
INSERT INTO immagine VALUES (10001, 'googlefan@gmail.com', '2016-05-25 19:12:56.054381+02', 'https://www.google.it/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&cad=rja&uact=8&ved=0ahUKEwiir6GlkePMAhXMBBoKHSjBABgQjBwIBA&url=http%3A%2F%2Fit.ubergizmo.com%2Fwp-content%2Fuploads%2F2013%2F06%2Fandroid-vs-apple.jpg&bvm=bv.122129774,d.d2s&psig=AFQjCNEYFR2C8mIcmdiZx7FeMWbNM7Rw_A&ust=1463644066006117', 'Apple sucks');
INSERT INTO immagine VALUES (10001, 'richard@gmail.com', '2016-05-25 19:13:03.18013+02', 'https://www.google.it/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&cad=rja&uact=8&ved=0ahUKEwj-kcT3j-PMAhXIaRQKHa50BIMQjBwIBA&url=https%3A%2F%2Fupload.wikimedia.org%2Fwikipedia%2Fcommons%2F9%2F93%2FGolfo_di_Sal%25C3%25B2.JPG&bvm=bv.122129774,d.d24&psig=AFQjCNFQBDoYuQW-Tu3VMZj6WuChsuIfZg&ust=1463643728799168', 'Salò e il suo lago');


--
-- Data for Name: luogo; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO luogo VALUES (10000, 'richard@gmail.com', '2016-05-18 09:28:47.643089+02', 48.137795, 11.580229);
INSERT INTO luogo VALUES (10001, 'richard@gmail.com', '2016-05-18 09:31:40.147266+02', 45.599655, 10.519028);
INSERT INTO luogo VALUES (10000, 'badass99@gmail.com', '2016-05-18 00:02:26.388038+02', -23.345641, -123.123456);
INSERT INTO luogo VALUES (10002, 'badass99@gmail.com', '2016-04-18 10:04:06.880708+02', 45.000000, 180.000000);
INSERT INTO luogo VALUES (10000, 'sempremorto@hotmail.it', '2016-05-18 10:25:38.286404+02', 23.000000, -142.445643);
INSERT INTO luogo VALUES (10001, 'badass99@gmail.com', '2016-05-25 19:13:21.878845+02', 34.445768, -12.334567);
INSERT INTO luogo VALUES (10003, 'badass99@gmail.com', '2016-05-25 19:13:27.785652+02', 19.223233, -164.333445);
INSERT INTO luogo VALUES (10000, 'marcolino@outlook.com', '2016-05-25 19:13:37.493147+02', 12.444550, 1.000000);


--
-- Data for Name: segnalato; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO segnalato VALUES (10000, 'googlefan@gmail.com', 'badass99@gmail.com');
INSERT INTO segnalato VALUES (10002, 'giapponeole@gmail.com', 'captainrussia@hotmail.com');


--
-- Data for Name: segue; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO segue VALUES ('bisboccia90@gmail.com', 'worder_s@outlook.com');
INSERT INTO segue VALUES ('captainrussia@hotmail.com', 'badass99@gmail.com');
INSERT INTO segue VALUES ('giapponeole@gmail.com', 'sempremorto@hotmail.it');
INSERT INTO segue VALUES ('captainrussia@hotmail.com', 'steve@outlook.com');
INSERT INTO segue VALUES ('marcolino@outlook.com', 'googlefan@gmail.com');
INSERT INTO segue VALUES ('giapponeole@gmail.com', 'googlefan@gmail.com');
INSERT INTO segue VALUES ('giapponeole@gmail.com', 'bisboccia90@gmail.com');
INSERT INTO segue VALUES ('captainrussia@hotmail.com', 'googlefan@gmail.com');
INSERT INTO segue VALUES ('marcolino@outlook.com', 'badass99@gmail.com');
INSERT INTO segue VALUES ('bisboccia90@gmail.com', 'giapponeole@gmail.com');


--
-- Data for Name: utente; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO utente VALUES ('bisboccia90@gmail.com', 'festa', 'Marco', 'Marcondino', '1990-05-26', 'Lodi', 'Lodi', true, false, NULL, NULL, 'Italia');
INSERT INTO utente VALUES ('marcolino@outlook.com', 'arduinoLove', 'Marcolino', 'Coppolati', '1987-01-13', 'Canusa', 'Canusa', true, false, NULL, NULL, 'Italia');
INSERT INTO utente VALUES ('sempremorto@hotmail.it', 'portafogli', 'Crilin', 'Alberti', '1981-09-03', 'Tokyo', 'Milano', true, false, NULL, NULL, 'Giappone');
INSERT INTO utente VALUES ('googlefan@gmail.com', 'AndroidBestOs', 'Giulia', 'Rossi', '1999-04-30', 'Pavia', 'Pavia', false, false, NULL, NULL, 'Italia');
INSERT INTO utente VALUES ('badass99@gmail.com', 'russia_power', 'Vladimir', 'Putin', '1960-07-10', 'Moscow', 'Moscow', true, false, NULL, NULL, 'Russia');
INSERT INTO utente VALUES ('worder_s@outlook.com', 'muricaSwag', 'Wonder', 'Woman', '1987-06-13', 'Boston', 'New York', false, false, NULL, NULL, 'USA');
INSERT INTO utente VALUES ('richard@gmail.com', 'gatto123', 'Richard David', 'Greco', '1990-12-28', 'Lodi', 'Lodi', true, false, NULL, NULL, 'Italia');
INSERT INTO utente VALUES ('steve@outlook.com', 'occhiali_da_sole', 'Stevie', 'Wonder', '1960-04-05', 'New York', 'Washington', true, false, NULL, NULL, 'USA');
INSERT INTO utente VALUES ('captainrussia@hotmail.com', 'vodkaPutin9', 'Dimitri', 'Sokov', '1980-08-15', 'Moscow', 'Moscow', true, false, 10000, 'badass99@gmail.com', 'Russia');
INSERT INTO utente VALUES ('giapponeole@gmail.com', 'hosomaki', 'Erminia', 'Lopinto', '1991-01-01', 'Milano', 'Milano', false, false, 10000, 'sempremorto@hotmail.it', 'Italia');


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

