/* Replace this file with actual dump of your database */
PRAGMA foreign_keys = false;

-- ----------------------------
--  Table structure for "tblcontact"
-- ----------------------------
DROP TABLE IF EXISTS "tblcontact";
DROP TABLE IF EXISTS "sqlite_sequence";
CREATE TABLE "tblcontact" (
  "id" integer PRIMARY KEY AUTOINCREMENT,
  "name" text(100,0) NOT NULL,
  "email" text(100,0) NOT NULL,
  "message" text NOT NULL
);

PRAGMA foreign_keys = true;
