# set character-set to utf8
SET NAMES 'utf8';

# use the database
USE `shop`;

#load data into the admin1codes table
LOAD DATA LOCAL INFILE 'admin1CodesASCII.txt' INTO TABLE `admin1codes` CHARACTER
SET utf8 (@concatid,name)
SET country_code=SUBSTRING_INDEX(@concatid,'.',1),
admin1_code=SUBSTRING_INDEX(@concatid,'.',-1);

#load data into the admin2codes table
LOAD DATA LOCAL INFILE 'admin2Codes.txt' INTO TABLE `admin2codes` CHARACTER
SET utf8 (@concatid,name,asciiname,geonameid)
SET country_code=SUBSTRING_INDEX(@concatid,'.',1),
admin1_code=SUBSTRING_INDEX(SUBSTRING_INDEX(@concatid,'.',2),'.',-1),
admin2_code=SUBSTRING_INDEX(@concatid,'.',-1);

#load data into the featurecodes table
LOAD DATA LOCAL INFILE 'featureCodes_en.txt' INTO TABLE `featurecodes`
CHARACTER SET utf8 (@concatid,name,description)
SET feature_class=SUBSTRING_INDEX(@concatid,'.',1),
feature_code=SUBSTRING_INDEX(@concatid,'.',-1);
LOAD DATA LOCAL INFILE 'US/US.txt' INTO TABLE `geonames` CHARACTER SET utf8
(geonameId,name,asciiname,alternatenames,latitude,longitude,feature_class,feature_code,country_code,cc2,admin1_code,admin2_code,admin3_code,admin4_code,population,elevation,gtopo30,timezone,modification_date);

