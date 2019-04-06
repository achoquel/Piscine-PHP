SELECT count(DISTINCT `id_film`) AS `films` FROM `member_history` WHERE DATEDIFF(`date`, '2006-10-30') >= 0 AND DATEDIFF(`date`, '2007-07-27') <= 0 OR DATE_FORMAT(`date`, '%m-%d') = '12-24';
