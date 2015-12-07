--EN SQLSERVER: Programación->Funciones->Funciones con valores de tabla
-- Inicio procedimiento almacenado
CREATE FUNCTION dbo.get_code_vendedores(@CodManager VARCHAR(12))
    RETURNS TABLE
/*
    Función recursiva que recupera todos los vendedores tanto managers como los
    subordinados de estos
*/
AS

    RETURN
    (
        --Sentencia recursiva
        WITH TmpVendedores(Code)
        AS
        (
            --Los vendedores del manager CodManager
            SELECT Code
            FROM core_users 
            WHERE Code_Manager = @CodManager
            
            UNION ALL

            SELECT u.Code 
            FROM core_users u

            --Los usuarios que son vendedores de los managers obtenidos
            INNER JOIN TmpVendedores v
            ON u.Code_Manager = v.Code
        )

        SELECT Code 
        FROM TmpVendedores

        UNION

        SELECT @CodManager
    )
-- fin procedimiento almacenado
GO