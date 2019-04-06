SELECT `last_name`, `first_name`
FROM `user_card`
WHERE LOCATE('-', `last_name`) OR LOCATE('-', `first_name`) OR (LOCATE('-', `last_name`) AND LOCATE('-', `first_name`)) ORDER BY `last_name`, `first_name`;
