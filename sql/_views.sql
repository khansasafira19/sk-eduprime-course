/* Run this views on SQL tab in PhpMyAdmin after exporting the sk_epc.sql"*/
CREATE OR REPLACE VIEW ranking
AS
SELECT ls.*
FROM latihan_siswa ls
JOIN (
   SELECT siswa, MIN(timestamp_siswa) AS timestamp_siswa
   FROM latihan_siswa
   WHERE deleted = 0 -- untuk mendapatkan latihan yang tidak dihapus aja
   GROUP BY latihan, siswa
) t ON ls.siswa = t.siswa AND ls.timestamp_siswa = t.timestamp_siswa;
