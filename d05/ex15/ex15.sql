SELECT TRIM(TRAILING 0 FROM REVERSE(`phone_number`)) AS `rebmunenohp`
FROM `distrib`
WHERE POSITION('05' IN `phone_number`) = 1;
