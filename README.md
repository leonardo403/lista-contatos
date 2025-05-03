# 📇 Contact Manager App

Plataforma web para cadastro de contatos com múltiplos endereços, login/autenticação com Laravel Sanctum e frontend em Vue 3.

---

## ⚙️ Tecnologias Utilizadas

### Backend
- [Laravel 12](https://laravel.com)
- PHP 8.1+
- MySQL
- Laravel Sanctum (autenticação SPA)
- Laravel HTTP Client (para ViaCEP)
- Service Layer, Repository, DTO
- Testes automatizados (PHPUnit)
- CI com GitHub Actions

### Frontend
- Vue 3 + Vite
- Axios
- Vue Router
- Tailwind CSS
- Google Maps Embed API
- Integração com Laravel Sanctum (SPA Auth)

---

## 🚀 Funcionalidades

- [x] Registro, Login e Logout de usuários
- [x] CRUD de Contatos com:
  - Nome completo
  - E-mail
  - Telefone
- [x] Relacionamento com múltiplos endereços:
  - CEP, rua, número, bairro, cidade, estado
  - Busca automática pelo CEP via [ViaCEP](https://viacep.com.br/)
  - Exibição de localização no Google Maps
- [x] Validações no Backend (Laravel Request) e Frontend
- [x] Testes automatizados
- [x] Boas práticas com:
  - Repository Pattern
  - DTO
  - Service Layer

---

## 🧪 Testes Automatizados

- Rodar todos os testes:

```bash
php artisan test
