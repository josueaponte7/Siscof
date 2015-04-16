SELECT 

fa.num_falla,
d.nombre_departamento
FROM fallas_asignada AS fa
INNER JOIN fallas AS f ON fa.num_falla=f.num_falla
INNER JOIN usuario_f AS uf ON f.usuario_fa_id=uf.id
INNER JOIN departamento AS d on uf.departamento_id=d.id
INNER JOIN estatus_fallas AS ef ON f.id_estatus=ef.id;
