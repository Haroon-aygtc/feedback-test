import React from 'react';
import styled from 'styled-components';

const ModalOverlay = styled.div`
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
`;

const ModalContent = styled.div`
  background-color: white;
  padding: 2.5rem;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
  max-width: 500px;
  width: 90%;
`;

const Title = styled.h2`
  color: #D39931;
  margin-top: 0;
  margin-bottom: 1rem;
  font-size: 24px;
  font-weight: 600;
`;

const Description = styled.p`
  color: black;
  margin-bottom: 1.5rem;
  font-size: 16px;
  line-height: 1.5;
`;

const List = styled.ul`
  padding-left: 20px;
  margin-bottom: 1.5rem;
  color: black;
`;

const ListItem = styled.li`
  margin-bottom: 0.5rem;
`;

const Button = styled.button`
  background-color: #D39931;
  color: white;
  border: none;
  padding: 12px 24px;
  border-radius: 6px;
  cursor: pointer;
  font-size: 16px;
  font-weight: 500;
  transition: background-color 0.2s ease;

  &:hover {
    background-color: #B38429;
  }

  &:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(211, 153, 49, 0.3);
  }
`;

/**
 * @typedef {Object} ValidationModalProps
 * @property {boolean} isOpen - Indicates if the modal is open
 * @property {() => void} onClose - Function to close the modal
 * @property {string} title - The title of the modal
 * @property {string} description - The description text for the modal
 */

/**
 * @type {ValidationModalProps}
 */
const ValidationModalProps = {
  isOpen: false,
  onClose: () => { },
  title: '',
  description: '',
  listItems: []
}

export default function ValidationModal({ isOpen, onClose, title, description, listItems = [] }) {
  if (!isOpen) return null;

  return (
    <ModalOverlay>
      <ModalContent>
        <Title>{title}</Title>
        <Description>{description}</Description>
        {listItems && listItems.length > 0 && (
          <List>
            {listItems.map((item, index) => (
              <ListItem key={index}>{item}</ListItem>
            ))}
          </List>
        )}
        <Button onClick={onClose}>Got it</Button>
      </ModalContent>
    </ModalOverlay>
  );
}