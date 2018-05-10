CREATE TABLE `baaskarrendb`.`opdrachten_norm` ( 
    `opdracht_normID` int AUTO_INCREMENT NOT NULL, 
    `laag` int NOT NULL, 
    `product` varchar(50) NOT NULL, 
    `kleur` varchar(50) NOT NULL, 
    `productB` varchar(50) NOT NULL, 
    `kleurB` varchar(50) NOT NULL,  
    PRIMARY KEY (`opdracht_normID`)
)