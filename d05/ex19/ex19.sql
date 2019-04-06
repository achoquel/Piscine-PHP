SELECT ABS(DATEDIFF(MAX(DATE_FORMAT(`date`, '%Y-%m-%d')), MIN(DATE_FORMAT(`date`, '%Y-%m-%d')))) AS `uptime`
FROM `member_history`;
