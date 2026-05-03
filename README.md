Il progetto è un sistema di gestione per una biblioteca o catalogo di libri, sviluppato utilizzando Laravel e MySQL.

## 📊 Architettura del Database

* **Many-to-Many (N:M): Gestione di Books ↔ Authors** Un libro può avere più autori e un autore può aver scritto più libri. Implementato tramite tabelle pivot ottimizzate (es. `author_book`).
* **Many-to-Many (N:M): Gestione di Books ↔ Categories** Un libro può appartenere a più categorie e ogni categoria include più libri. Implementato tramite tabelle pivot ottimizzate (es. `book_category`).

## 💻 Tech Stack

Il progetto è stato sviluppato utilizzando le seguenti tecnologie:

* **Backend:** Laravel
* **Database:** MySQL

