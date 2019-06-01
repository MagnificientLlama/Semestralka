
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- author
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `author`;

CREATE TABLE `author`
(
    `authID` INTEGER NOT NULL AUTO_INCREMENT,
    `authName` VARCHAR(255) NOT NULL,
    `dateOfBirth` DATE NOT NULL,
    PRIMARY KEY (`authID`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- book
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `book`;

CREATE TABLE `book`
(
    `bookID` INTEGER NOT NULL AUTO_INCREMENT,
    `bookName` VARCHAR(255) NOT NULL,
    `yearOfRelease` DATE NOT NULL,
    `bookDescription` VARCHAR(255) NOT NULL,
    `ISBN` VARCHAR(255) NOT NULL,
    `bookImage` VARCHAR(255),
    `author_authID1` INTEGER NOT NULL,
    PRIMARY KEY (`bookID`),
    UNIQUE INDEX `bookName_UNIQUE` (`bookName`),
    UNIQUE INDEX `ISBN_UNIQUE` (`ISBN`),
    INDEX `fk_book_author1_idx` (`author_authID1`),
    CONSTRAINT `fk_book_author1`
        FOREIGN KEY (`author_authID1`)
        REFERENCES `author` (`authID`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- bookinreadinglist
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `bookinreadinglist`;

CREATE TABLE `bookinreadinglist`
(
    `readingList_RLID` INTEGER NOT NULL,
    `book_bookID` INTEGER NOT NULL,
    PRIMARY KEY (`readingList_RLID`,`book_bookID`),
    INDEX `fk_readingList_has_book_book1_idx` (`book_bookID`),
    INDEX `fk_readingList_has_book_readingList1_idx` (`readingList_RLID`),
    CONSTRAINT `fk_readingList_has_book_book1`
        FOREIGN KEY (`book_bookID`)
        REFERENCES `book` (`bookID`),
    CONSTRAINT `fk_readingList_has_book_readingList1`
        FOREIGN KEY (`readingList_RLID`)
        REFERENCES `readinglist` (`RLID`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- booktagged
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `booktagged`;

CREATE TABLE `booktagged`
(
    `tag_tagName` VARCHAR(255) NOT NULL,
    `book_bookID` INTEGER NOT NULL,
    PRIMARY KEY (`tag_tagName`,`book_bookID`),
    INDEX `fk_tag_has_book_book1_idx` (`book_bookID`),
    INDEX `fk_tag_has_book_tag1_idx` (`tag_tagName`),
    CONSTRAINT `fk_tag_has_book_book1`
        FOREIGN KEY (`book_bookID`)
        REFERENCES `book` (`bookID`),
    CONSTRAINT `fk_tag_has_book_tag1`
        FOREIGN KEY (`tag_tagName`)
        REFERENCES `tag` (`tagName`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- chapter
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `chapter`;

CREATE TABLE `chapter`
(
    `chapterID` INTEGER NOT NULL AUTO_INCREMENT,
    `chapterName` VARCHAR(255) NOT NULL,
    `book_bookID` INTEGER NOT NULL,
    PRIMARY KEY (`chapterID`),
    INDEX `fk_chapter_book1_idx` (`book_bookID`),
    CONSTRAINT `fk_chapter_book1`
        FOREIGN KEY (`book_bookID`)
        REFERENCES `book` (`bookID`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- readinglist
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `readinglist`;

CREATE TABLE `readinglist`
(
    `RLID` INTEGER NOT NULL AUTO_INCREMENT,
    `RLName` VARCHAR(255) NOT NULL,
    `user_userID1` INTEGER NOT NULL,
    PRIMARY KEY (`RLID`),
    UNIQUE INDEX `RLName_UNIQUE` (`RLName`),
    INDEX `fk_readingList_user1_idx` (`user_userID1`),
    CONSTRAINT `fk_readingList_user1`
        FOREIGN KEY (`user_userID1`)
        REFERENCES `user` (`userID`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tag
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tag`;

CREATE TABLE `tag`
(
    `tagName` VARCHAR(255) NOT NULL,
    `tagDescription` TEXT NOT NULL,
    PRIMARY KEY (`tagName`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `userID` INTEGER NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `privilegy` INTEGER DEFAULT 1 NOT NULL,
    `userAvatar` VARCHAR(255),
    PRIMARY KEY (`userID`),
    UNIQUE INDEX `email_UNIQUE` (`email`),
    UNIQUE INDEX `username_UNIQUE` (`username`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- userrating
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `userrating`;

CREATE TABLE `userrating`
(
    `ratingID` INTEGER NOT NULL AUTO_INCREMENT,
    `rating` INTEGER NOT NULL,
    `user_userID` INTEGER NOT NULL,
    `book_bookID` INTEGER NOT NULL,
    PRIMARY KEY (`ratingID`,`user_userID`,`book_bookID`),
    INDEX `fk_UserRating_user1_idx` (`user_userID`),
    INDEX `fk_UserRating_book1_idx` (`book_bookID`),
    CONSTRAINT `fk_UserRating_book1`
        FOREIGN KEY (`book_bookID`)
        REFERENCES `book` (`bookID`),
    CONSTRAINT `fk_UserRating_user1`
        FOREIGN KEY (`user_userID`)
        REFERENCES `user` (`userID`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
