import React, { useState } from 'react';
import { View, Text, StyleSheet, Alert } from 'react-native';
import { Button, Input, Icon } from '@rneui/themed';
import { useNavigation } from '@react-navigation/native';

const RegistrationScreen = () => {
  const navigation = useNavigation();
  
  const [userName, setUserName] = useState('');
  const [userFullName, setUserFullName] = useState('');
  const [userEmail, setUserEmail] = useState('');
  const [userPassword, setUserPassword] = useState('');
  
  const registerUser = async () => {
    // Basic validation
    if (!userEmail.includes('@')) {
      Alert.alert('Invalid Email', 'Please enter a valid email address');
      return;
    }
    if (userPassword.length < 8) {
      Alert.alert('Weak Password', 'Password must be at least 8 characters long');
      return;
    }
    
    // Prepare user data
    const userData = {
      username: userName,
      fullName: userFullName,
      email: userEmail,
      password: userPassword
    };
  
    try {
      // Make API call to register user
      const response = await fetch("http://172.22.112.1/Library/api/users/create", {
        method: 'POST',
        headers: { 
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(userData),
      });

      // Check if registration was successful
      if (response.ok) {
        Alert.alert('Registration Successful', 'You can now log in using your credentials.');
        navigation.navigate('LoginScreen');
      } else {
        // Handle non-JSON response
        const errorText = await response.text();
        Alert.alert('Registration Failed', errorText || 'An error occurred while registering. Please try again.');
      }
    } catch (error) {
      console.error('Error registering user:', error);
      Alert.alert('Registration Failed', 'An error occurred while registering. Please try again.');
    }
  };
  
  return (
    <View style={styles.container}>
      <Text style={styles.title}>Library</Text>
      <Text style={styles.subtitle}>Create your account</Text>
      
      <Input
        label="Username"
        placeholder="Enter Username"
        onChangeText={setUserName}
        value={userName}
        leftIcon={<Icon name="user" type="font-awesome" color="#6A1B9A" />}
        containerStyle={styles.inputContainer}
        inputStyle={styles.input}
        labelStyle={styles.label}
      />
      
      <Input
        label="Full Name"
        placeholder="Enter Full Name"
        onChangeText={setUserFullName}
        value={userFullName}
        leftIcon={<Icon name="id-card" type="font-awesome" color="#6A1B9A" />}
        containerStyle={styles.inputContainer}
        inputStyle={styles.input}
        labelStyle={styles.label}
      />
      
      <Input
        label="Email"
        placeholder="Enter Email"
        onChangeText={setUserEmail}
        value={userEmail}
        leftIcon={<Icon name="envelope" type="font-awesome" color="#6A1B9A" />}
        containerStyle={styles.inputContainer}
        inputStyle={styles.input}
        labelStyle={styles.label}
      />
      
      <Input
        label="Password"
        placeholder="Enter Password"
        onChangeText={setUserPassword}
        value={userPassword}
        secureTextEntry
        leftIcon={<Icon name="lock" type="font-awesome" color="#6A1B9A" />}
        containerStyle={styles.inputContainer}
        inputStyle={styles.input}
        labelStyle={styles.label}
      />
      
      <Button
        onPress={registerUser}
        title="Register"
        buttonStyle={styles.registerButton}
        icon={<Icon name="user-plus" type="font-awesome" color="white" />}
        titleStyle={styles.buttonTitle}
      />
      
      <Text
        style={styles.textLogin}
        onPress={() => navigation.navigate('LoginScreen')}
      >
        Already have an account? Login
      </Text>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#F0F0F5',
    justifyContent: 'center',
    paddingHorizontal: 16,
  },
  title: {
    fontSize: 32,
    fontWeight: 'bold',
    textAlign: 'center',
    color: '#6A1B9A',
    marginBottom: 10,
  },
  subtitle: {
    fontSize: 16,
    textAlign: 'center',
    color: '#777',
    marginBottom: 20,
  },
  inputContainer: {
    marginBottom: 20,
  },
  input: {
    fontSize: 16,
    paddingVertical: 10,
  },
  label: {
    color: '#6A1B9A',
    fontWeight: 'bold',
  },
  registerButton: {
    backgroundColor: '#6A1B9A',
    borderRadius: 8,
    marginHorizontal: 16,
    marginVertical: 8,
    paddingVertical: 15,
  },
  buttonTitle: {
    fontSize: 18,
    fontWeight: 'bold',
  },
  textLogin: {
    textAlign: 'center',
    color: '#6A1B9A',
    marginVertical: 10,
    fontSize: 16,
  },
});

export default RegistrationScreen;
