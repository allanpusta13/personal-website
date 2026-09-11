import express from "express";
import path from "path";
import { fileURLToPath } from "url";

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const app = express();
const PORT = 3000;

app.use(express.json());

// API route for contact form submission
app.post("/api/contact", (req, res) => {
  const { name, email, service, message } = req.body || {};

  if (!name || !email || !message) {
    return res.status(400).json({
      success: false,
      error: "Please fill in all required fields (Name, Email, and Message).",
    });
  }

  // Basic email validation regex
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    return res.status(400).json({
      success: false,
      error: "Please provide a valid email address.",
    });
  }

  console.log(`[Contact Form Submission] from "${name}" <${email}>:`, {
    service: service || "General Inquiry",
    message,
    timestamp: new Date().toISOString(),
  });

  return res.json({
    success: true,
    message:
      "Thank you! Your message has been received. I will get back to you shortly.",
    data: {
      name,
      email,
      service,
    },
  });
});

// Serve static assets
app.use(express.static(__dirname));

// Fallback to index.html for SPA/root routes
app.use((req, res) => {
  res.sendFile(path.join(__dirname, "index.html"));
});

app.listen(PORT, "0.0.0.0", () => {
  console.log(`Portfolio server running at http://0.0.0.0:${PORT}`);
});
