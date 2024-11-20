// Melhor gerenciamento de validações e feedback visual
class FormValidator {
  constructor(formId) {
    this.form = document.getElementById(formId);
    this.errors = new Map();

    // Configuração das validações
    this.validations = {
      nome: {
        pattern: /^[A-Za-zÀ-ÖØ-öø-ÿ\s]{3,}$/,
        message: "Nome deve ter pelo menos 3 letras e não conter números ou caracteres especiais",
      },
      email: {
        pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        message: "Por favor, insira um email válido",
      },
      username: {
        pattern: /^[a-zA-Z0-9_]{3,15}$/,
        message: "Username deve ter entre 3 e 15 caracteres (letras, números e _)",
      },
      senha: {
        pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/,
        message:
          "Senha deve ter 8+ caracteres, incluindo maiúscula, minúscula, número e caractere especial",
      },
    };

    this.setupEventListeners();
  }

  setupEventListeners() {
    // Validação em tempo real
    this.form.querySelectorAll("input").forEach((input) => {
      input.addEventListener("input", () => this.validateField(input));
      input.addEventListener("blur", () => this.validateField(input));
    });

    // Validação no envio
    this.form.addEventListener("submit", (e) => this.handleSubmit(e));
  }

  validateField(input) {
    const field = input.id;
    const value = input.value.trim();

    // Remove erro existente
    this.removeError(field);

    // Verifica campo vazio
    if (!value) {
      this.showError(field, "Este campo é obrigatório");
      return false;
    }

    // Validação específica do campo
    if (this.validations[field]) {
      if (!this.validations[field].pattern.test(value)) {
        this.showError(field, this.validations[field].message);
        return false;
      }
    }

    // Validações adicionais para senha
    if (field === "senha") {
      const strengthResult = this.checkPasswordStrength(value);
      if (!strengthResult.strong) {
        this.showError(field, strengthResult.message);
        return false;
      }
    }

    return true;
  }

  checkPasswordStrength(password) {
    let strength = 0;
    const messages = [];

    if (password.length >= 8) strength++;
    else messages.push("mínimo 8 caracteres");

    if (/[A-Z]/.test(password)) strength++;
    else messages.push("uma letra maiúscula");

    if (/[a-z]/.test(password)) strength++;
    else messages.push("uma letra minúscula");

    if (/[0-9]/.test(password)) strength++;
    else messages.push("um número");

    if (/[@$!%*?&]/.test(password)) strength++;
    else messages.push("um caractere especial");

    return {
      strong: strength === 5,
      message: `Senha deve conter: ${messages.join(", ")}`,
    };
  }

  showError(field, message) {
    const input = this.form.querySelector(`#${field}`);
    const errorDiv = document.createElement("div");
    errorDiv.className = "error-message";
    errorDiv.textContent = message;

    input.classList.add("error");
    input.parentElement.appendChild(errorDiv);
    this.errors.set(field, message);
  }

  removeError(field) {
    const input = this.form.querySelector(`#${field}`);
    const errorDiv = input.parentElement.querySelector(".error-message");

    if (errorDiv) {
      errorDiv.remove();
      input.classList.remove("error");
      this.errors.delete(field);
    }
  }

  handleSubmit(e) {
    e.preventDefault();
    let isValid = true;

    // Valida todos os campos
    this.form.querySelectorAll("input").forEach((input) => {
      if (!this.validateField(input)) {
        isValid = false;
      }
    });

    if (isValid) {
      // Aqui você pode adicionar a lógica de envio do formulário
      const formData = new FormData(this.form);
      const data = Object.fromEntries(formData);

      // Simulação de envio
      console.log("Dados do cadastro:", data);

      // Feedback visual de sucesso
      this.showSuccessMessage();

      // Limpa o formulário
      this.form.reset();
    }
  }

  showSuccessMessage() {
    const successDiv = document.createElement("div");
    successDiv.className = "success-message";
    successDiv.textContent = "Cadastro realizado com sucesso!";

    this.form.parentElement.insertBefore(successDiv, this.form);

    // Remove a mensagem após 3 segundos
    setTimeout(() => successDiv.remove(), 3000);
  }
}

// Inicialização
document.addEventListener("DOMContentLoaded", () => {
  new FormValidator("cadastroForm"); // Substitua 'cadastroForm' pelo ID do seu formulário
});
