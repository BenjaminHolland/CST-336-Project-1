-- Exported from QuickDBD: https://www.quickdatatabasediagrams.com/
-- NOTE! If you have used non-SQL datatypes in your design, you will have to change these here.

CREATE TABLE "Villian" (
    "VillianId" int  NOT NULL ,
    "Name" varchar(128) NOT NULL ,
    "Address" varchar(1024)  NOT NULL ,
    CONSTRAINT "pk_Villian" PRIMARY KEY (
        "VillianId"
    )
)

GO

CREATE TABLE "Order" (
    "OrderId" int  NOT NULL ,
    "VillianIdId" int  NOT NULL ,
    "OrderStatusId" int  NOT NULL ,
    CONSTRAINT "pk_Order" PRIMARY KEY (
        "OrderId"
    )
)

GO

CREATE TABLE "OrderLine" (
    "OrderLineId" int  NOT NULL ,
    "OrderId" int  NOT NULL ,
    "HenchpersonId" int  NOT NULL ,
    CONSTRAINT "pk_OrderLine" PRIMARY KEY (
        "OrderLineId"
    )
)

GO

CREATE TABLE "Henchperson" (
    "HenchpersonId" int  NOT NULL ,
    "Name" varchar(200)  NOT NULL ,
    "Description" varchar(1024)  NOT NULL ,
    "RatePerHour" money  NOT NULL ,
    "HenchersonStatusId" int  NOT NULL ,
    "SpecialityId" int  NOT NULL ,
    CONSTRAINT "pk_Henchperson" PRIMARY KEY (
        "HenchpersonId"
    )
)

GO

CREATE TABLE "Speciality" (
    "SpecialityId" int  NOT NULL ,
    "Description" varchar(1024)  NOT NULL ,
    CONSTRAINT "pk_Speciality" PRIMARY KEY (
        "SpecialityId"
    )
)

GO

CREATE TABLE "HenchpersonStatus" (
    "HenchpersonStatusId" int  NOT NULL ,
    "Description" varchar(64)  NOT NULL ,
    CONSTRAINT "pk_HenchpersonStatus" PRIMARY KEY (
        "HenchpersonStatusId"
    )
)

GO

CREATE TABLE "OrderStatus" (
    "OrderStatusID" int  NOT NULL ,
    "Name" string  NOT NULL ,
    CONSTRAINT "pk_OrderStatus" PRIMARY KEY (
        "OrderStatusID"
    )
)

GO

ALTER TABLE "Order" ADD CONSTRAINT "fk_Order_VillianIdId" FOREIGN KEY("VillianIdId")
REFERENCES "Villian" ("VillianId")
GO

ALTER TABLE "Order" ADD CONSTRAINT "fk_Order_OrderStatusId" FOREIGN KEY("OrderStatusId")
REFERENCES "OrderStatus" ("OrderStatusID")
GO

ALTER TABLE "OrderLine" ADD CONSTRAINT "fk_OrderLine_OrderId" FOREIGN KEY("OrderId")
REFERENCES "Order" ("OrderId")
GO

ALTER TABLE "OrderLine" ADD CONSTRAINT "fk_OrderLine_HenchpersonId" FOREIGN KEY("HenchpersonId")
REFERENCES "Henchperson" ("HenchpersonId")
GO

ALTER TABLE "Henchperson" ADD CONSTRAINT "fk_Henchperson_HenchersonStatusId" FOREIGN KEY("HenchersonStatusId")
REFERENCES "HenchpersonStatus" ("HenchpersonStatusId")
GO

ALTER TABLE "Henchperson" ADD CONSTRAINT "fk_Henchperson_SpecialityId" FOREIGN KEY("SpecialityId")
REFERENCES "Speciality" ("SpecialityId")
GO

