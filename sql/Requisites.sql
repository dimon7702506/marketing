// okpo name

SELECT okpo, firm.name, last_receipt_oreder_number, last_expense_order_number, last_cashiers_report_number
FROM firm, apteka
WHERE firm.id = (SELECT apteka.firm_id FROM apteka WHERE apteka.id = 2)
AND apteka.id = 2;

//вариант 2

SELECT okpo, firm.name as firma, last_receipt_oreder_number, 	last_expense_order_number, last_cashiers_report_number
FROM apteka
LEFT JOIN firm ON firm.id = firm_id
WHERE apteka.id = 2;