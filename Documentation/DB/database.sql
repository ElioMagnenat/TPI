CREATE TABLE Student (
    id_student INT AUTO_INCREMENT PRIMARY KEY,
    lastname VARCHAR(100),
    firstname VARCHAR(100),
    birthdate DATE,
    institution VARCHAR(150),
    entry_date DATE,
    validity_date DATE,
    phone VARCHAR(20),
    comment TEXT,
    address TEXT,
    photo VARCHAR(255)
);

CREATE TABLE Book (
    id_book INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    author VARCHAR(150),
    edition VARCHAR(100),
    category VARCHAR(100),
    reference VARCHAR(100),
    location VARCHAR(100),
    status VARCHAR(50),
    comment TEXT,
    photo VARCHAR(255)
);

CREATE TABLE Loan (
    id_loan INT AUTO_INCREMENT PRIMARY KEY,
    start_date DATE,
    expected_return_date DATE,
    return_date DATE,
    comment TEXT,
    fk_student INT,
    fk_book INT,
    CONSTRAINT fk_student FOREIGN KEY (fk_student) REFERENCES Student(id_student),
    CONSTRAINT fk_book FOREIGN KEY (fk_book) REFERENCES Book(id_book)
);
