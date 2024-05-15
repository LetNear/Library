import React, { useState, useContext } from "react";
import { View, Text, StyleSheet, Alert } from "react-native";
import { useNavigation } from "@react-navigation/native";
import { Button, Input, Icon } from "@rneui/themed";
import { compare } from "bcryptjs";
import Loader from "../Loader";
import { AuthContext } from "../AuthContext";

const LoginScreen = () => {
  const navigation = useNavigation();
  const [userEmail, setUserEmail] = useState("");
  const [userPassword, setUserPassword] = useState("");
  const [loading, setLoading] = useState(false);
  const { setUser } = useContext(AuthContext);

  const handleLogin = async () => {
    try {
      setLoading(true);

      const params = new URLSearchParams();
      params.append("email", userEmail);

      const url = new URL("http://172.22.112.1/Library/api/user/email");
      url.search = params;

      const response = await fetch(url, {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
      });

      if (response.ok) {
        const userData = (await response.json()).data;
        compare(userPassword, userData.password, function (err, result) {
          if (err) {
            console.error("Unexpected error:", err);
            Alert.alert("Error", "An unexpected error occurred. Please try again.");
            return;
          }

          if (result) {
            Alert.alert("Login Successful", "Welcome back to Library!");
            setUser(userData);
            navigation.navigate("HomeScreen");
          } else {
            Alert.alert("Login Failed", "Invalid credentials. Please try again.");
          }
        });
      } else {
        const errorText = await response.text();
        Alert.alert("Login Failed", errorText || "An error occurred while logging in. Please try again.");
      }
    } catch (error) {
      console.error("Error logging in:", error);
      Alert.alert("Error", "An error occurred while logging in. Please try again later.");
    } finally {
      setLoading(false);
    }
  };

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Library</Text>
      <Text style={styles.subtitle}>Where Books Can Be Bought</Text>
      <Input
        label="Email Address"
        leftIcon={<Icon name="envelope" type="font-awesome" color="#6A1B9A" />}
        placeholder="Enter your Email Address"
        onChangeText={setUserEmail}
        value={userEmail}
        autoCapitalize="none"
        keyboardType="email-address"
        textContentType="emailAddress"
        inputContainerStyle={styles.inputContainer}
        inputStyle={styles.input}
        labelStyle={styles.label}
      />
      <Input
        label="Password"
        leftIcon={<Icon name="key" type="font-awesome" color="#6A1B9A" />}
        placeholder="Enter your Password"
        onChangeText={setUserPassword}
        value={userPassword}
        secureTextEntry
        textContentType="password"
        inputContainerStyle={styles.inputContainer}
        inputStyle={styles.input}
        labelStyle={styles.label}
      />
      <Button
        onPress={handleLogin}
        title="Login"
        buttonStyle={styles.loginButton}
        icon={<Icon name="sign-in" type="font-awesome" color="white" />}
        titleStyle={styles.buttonTitle}
      />
      <Text
        style={styles.textRegister}
        onPress={() => navigation.navigate("RegistrationScreen")}
      >
        Don't have an account? Register
      </Text>
      {loading && <Loader visible={loading} />}
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: "#F0F0F5",
    justifyContent: "center",
    paddingHorizontal: 20,
    paddingVertical: 40,
  },
  title: {
    fontSize: 34,
    fontWeight: "bold",
    textAlign: "center",
    color: "#6A1B9A",
    marginBottom: 10,
  },
  subtitle: {
    fontSize: 18,
    textAlign: "center",
    color: "#777",
    marginBottom: 20,
  },
  textRegister: {
    textAlign: "center",
    color: "#6A1B9A",
    marginVertical: 20,
    fontSize: 16,
  },
  loginButton: {
    marginHorizontal: 16,
    marginVertical: 20,
    borderRadius: 8,
    backgroundColor: "#6A1B9A",
    paddingVertical: 15,
  },
  buttonTitle: {
    fontSize: 18,
    fontWeight: "bold",
  },
  inputContainer: {
    borderBottomWidth: 1,
    borderColor: "#6A1B9A",
    marginVertical: 10,
  },
  input: {
    fontSize: 16,
    paddingVertical: 10,
  },
  label: {
    color: "#6A1B9A",
    fontWeight: "bold",
  },
});

export default LoginScreen;
