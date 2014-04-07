DROP VIEW IF EXISTS totaal;

CREATE VIEW totaal AS
SELECT slot_1 AS team, SUM(gelijk) AS tot1 FROM poulewedstrijden
GROUP BY team 
UNION ALL
SELECT slot_2 AS team, SUM(gelijk) AS tot1 FROM poulewedstrijden
GROUP BY team;

SELECT team, SUM(tot1) AS totaal_gelijk
FROM totaal
GROUP BY team
