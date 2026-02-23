require("dotenv").config();
const express = require("express");
const bcrypt = require("bcryptjs");
const path = require("path");

const connectDB = require("./db"); // Pointing to your main folder
const User = require("./userModel"); // Pointing to your main folder

const app = express();
connectDB();

app.use(express.urlencoded({ extended: true }));
app.use(express.json());

// Serving your HTML files directly from the main folder
app.get("/", (req, res) => res.sendFile(path.join(__dirname, "login.html")));
app.get("/signup.html", (req, res) => res.sendFile(path.join(__dirname, "signup.html")));
app.get("/login.html", (req, res) => res.sendFile(path.join(__dirname, "login.html")));

/* CREATE: SIGNUP */
app.post("/signup", async (req, res) => {
  try {
    const { name, email, password } = req.body;
    if (!name || !email || !password) return res.status(400).send("All fields required");

    const userExists = await User.findOne({ email });
    if (userExists) return res.status(400).send("Email already in use");

    const hashedPassword = await bcrypt.hash(password, 10);
    await User.create({ name, email, password: hashedPassword });

    res.redirect("/login.html");
  } catch (error) {
    res.status(500).send("Signup error: " + error.message);
  }
});

/* READ: LOGIN */
app.post("/login", async (req, res) => {
  try {
    const { email, password } = req.body;
    const user = await User.findOne({ email });
    if (!user) return res.status(400).send("Invalid credentials");

    const match = await bcrypt.compare(password, user.password);
    if (!match) return res.status(400).send("Invalid credentials");

    res.redirect(`/dashboard?name=${user.name}&email=${user.email}`);
  } catch (error) {
    res.status(500).send("Login error: " + error.message);
  }
});

/* DASHBOARD (Includes Update and Delete Forms) */
app.get("/dashboard", (req, res) => {
  const { name, email } = req.query;
  if (!name || !email) return res.redirect("/login.html");

  res.send(`
    <h2>Welcome, ${name}</h2>
    <p>Logged in as: ${email}</p>
    <hr>
    <h3>Update Profile</h3>
    <form action="/update" method="POST">
      <input type="hidden" name="email" value="${email}">
      <input type="text" name="newName" placeholder="Enter new name" required>
      <button type="submit">Update Name</button>
    </form>
    <br><hr><br>
    <h3>Danger Zone</h3>
    <form action="/delete" method="POST">
      <input type="hidden" name="email" value="${email}">
      <button type="submit" style="color: red;">Delete My Account</button>
    </form>
  `);
});

/* UPDATE: CHANGE NAME */
app.post("/update", async (req, res) => {
  try {
    const { email, newName } = req.body;
    await User.findOneAndUpdate({ email }, { name: newName });
    res.send(`Profile updated successfully! New name: ${newName}. <br><a href="/login.html">Login again to see changes</a>`);
  } catch (error) {
    res.status(500).send("Update error: " + error.message);
  }
});

/* DELETE: REMOVE ACCOUNT */
app.post("/delete", async (req, res) => {
  try {
    const { email } = req.body;
    await User.findOneAndDelete({ email });
    res.send(`Account deleted successfully. <br><a href="/signup.html">Create a new account</a>`);
  } catch (error) {
    res.status(500).send("Delete error: " + error.message);
  }
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => console.log(`Server running locally on http://localhost:${PORT}`));