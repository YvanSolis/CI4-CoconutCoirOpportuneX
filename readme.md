<a name="readme-top"></a>

<br/>
<br/>

<div align="center">
  <a href="https://github.com/ArwenQuemuel0/">
    <img src="backend/public/assets/arwenpic.jpg" alt="Arwen" width="130" height="130">
  </a>
<!-- * Title Section -->
  <h3 align="center">Achlys' Bookstore</h3>
</div>

<!-- * Description Section -->
<div align="center">
Where shadows meet stories — discover timeless tales that linger long after the last page.
</div>

<br/>

![](https://visit-counter.vercel.app/counter.png?page=zyx-0314/ci4-template)

<!-- ! Make sure it was similar to your github -->

---

<br/>
<br/>

<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#overview">Overview</a>
      <ol>
        <li>
          <a href="#key-components">Key Components</a>
        </li>
        <li>
          <a href="#technology">Technology</a>
        </li>
      </ol>
    </li>
    <li>
      <a href="#rules-practices-and-principles">Rules, Practices and Principles</a>
    </li>
    <li>
      <a href="#resources">Resources</a>
    </li>
  </ol>
</details>

---

## Overview

This system provides an online eBook purchasing platform where users can browse, explore, and buy digital books across various genres.

It is designed to be user-friendly, responsive, and aesthetic, offering a smooth reading and purchasing experience inspired by the charm of dark academia.

* *Purpose*: to make discovering and purchasing eBooks simple and immersive.
* *Audience*: readers and book enthusiasts who enjoy exploring stories through a digital bookstore experience.

### Key Components

These are *sample modules* included (or suggested) for learning how to add features:

| Component                 | Purpose                                                             | Notes                                                   |
| ------------------------- | ------------------------------------------------------------------- | ------------------------------------------------------- |
| *Auth (Sample)*         | Basic login/logout and role check (admin/user).                     | Uses CI4 sessions + MySQL users table.                |
| *CRUD Module*           | Example entity (Posts or Tasks) with create/read/update/delete. | Demonstrates Controller → Service → Repository pattern. |
| *Scheduler (Sample)*    | Simple to-do list with due dates.                                   | Shows how to extend with new tables and services.       |

 <!-- ! Start simple. Use these modules as *learning samples*; extend or replace them based on your project’s needs. -->

### Technology

#### Language

![HTML](https://img.shields.io/badge/HTML-E34F26?style=for-the-badge\&logo=html5\&logoColor=white)
![CSS](https://img.shields.io/badge/CSS-1572B6?style=for-the-badge\&logo=css3\&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge\&logo=javascript\&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge\&logo=php\&logoColor=white)

#### Framework/Library

![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-06B6D4?style=for-the-badge\&logo=tailwindcss\&logoColor=white)
![CodeIgniter](https://img.shields.io/badge/CodeIgniter-EF4223?style=for-the-badge\&logo=codeigniter\&logoColor=white)

#### Databases

<!-- ! Keep only the used technology -->

---

## Quick Start (Docker)

Run the development stack and the app (rebuild if needed):

cmd
docker compose up --watch

- Create a controller (add --resource to scaffold resourceful methods if you like) (using CodeIgniter's spark tool):
cmd
docker compose exec php php spark make:controller Users

If you prefer, you can include -f "compose.yaml" explicitly; the shorter commands above work when running from the repo root.

## Ports & Database

Defaults used in this project (host mapping):

| Service     | Host port |
|-------------|-----------:|
| nginx (app) | 8090      |

Database credentials used in examples and CI:

- Host: localhost
- Port: 3390
- Database: app
- User: root
- Password: root

Be careful: seeding and truncating are destructive operations — run only on local/dev environments unless you know what you're doing.

## Rules, Practices and Principles

<!-- ! Dont Revise this -->

1. Always prefix project titles with AD-.
2. Place files in their *respective CI4 folders* (Controllers/, Services/, Repositories/, Views/).
3. Naming conventions:

   | Type             | Case        | Example                   |
   | ---------------- | ----------- | ------------------------- |
   | Classes          | PascalCase  | UserService.php         |
   | Interfaces       | PascalCase  | UserRepositoryInterface |
   | DB tables/fields | snake\_case | users, created_at     |
   | Docs             | kebab-case  | dev-manual.md           |

4. Git commits use: feat, fix, docs, refactor.
5. Use *Controller → Service → Repository* pattern.
6. Assets (CSS/JS/img) live under public/.
7. Docker configs are at the repo root (docker-compose.yml, nginx.conf).
8. Docs are maintained in /docs (dev, technical, sop, commit, principles, copilot).

Example structure:

AD-ProjectName/
├─ backend/ci4/
│  ├─ app/Controllers/
│  ├─ app/Services/
│  ├─ app/Repositories/
│  ├─ app/Views/
│  ├─ public/
│  ├─ writable/
│  ├─ .env
│  └─ composer.json
├─ docker/               # Docker configs at root
├─ docs/                 # Manuals and project docs
├─ .gitignore
└─ readme.md

<!-- ! Dont Revise this -->

---

## Resources

| Title                   | Purpose                                                               | Link                                                                       |
| ----------------------- | --------------------------------------------------------------------- | -------------------------------------------------------------------------- |
| ChatGPT                 | General AI assistance for planning application architecture and docs. | [https://chat.openai.com](https://chat.openai.com)                         |
| GitHub Copilot          | In-IDE code suggestions and boilerplate generation.                   | [https://github.com/features/copilot](https://github.com/features/copilot) |
| Google Photos (Assets)  | Stock imagery and graphics used in UI mockups and documentation.      | [https://photos.google.com](https://photos.google.com)                     |
| System Documentation    | Internal docs from PHP, MongoDB, and PostgreSQL used in development.  | — (see /docs folder in repo)                                             |

<!-- ! Add what tools aided you -->